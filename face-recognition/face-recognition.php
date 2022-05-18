

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Custom CSS -->

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
		<link rel="icon" href="images/ojt_logo.png" type="image/x-icon">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-
		<script src="face-api.js"></script></head>

<head>
    <title>SLSU OJT Timesheet Monitoring and Journal System using Face Recognition</title>
</head>
<body>
    <main>

	<div class="container h-100">

  <div class="row h-100 justify-content-center align-items-center">
	 
            <div class="col-lg-4 p-6">
					<div style="height:250px;"></div>
					<input id = "name" value="<?php echo $_GET['stud_name'];?>" type="hidden" >
					<input id = "student_id" value="<?php echo $_GET['stud_id'];?>" type="hidden" >
					<input id = "stud_dprtmnt" value="<?php echo $_GET['stud_dprtmnt'];?>" type="hidden" >
					<input id = "stud_section" value="<?php echo $_GET['stud_section'];?>" type="hidden" >
					<input id = "stud_email" value="<?php echo $_GET['stud_email'];?>" type="hidden" >
					<input id = "stud_pass" value="<?php echo $_GET['stud_pass'];?>" type="hidden" >
					<img id = "prof_img" class=" text-center" style= "display: block;margin:0 auto; height:200px; width: 200px;" ></img><br><br>
                    <div id="tries" style="margin-left: 80px; font-size: 23px; font-family:Lucida Console,Monaco,monospace; font-weight: bold;">Capture Left : </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5 button1" id="capture" >Capture</button>
                  
            </div>
            <div class="col-lg-8 ">
				   <div id="parent1">
					  <div class="margin" style="position: relative;">
						<video id="vidDisplay" style="height: 800px; width: 1200px; display: inline-block; vertical-align: baseline;" onloadedmetadata="onPlay(this)" autoplay="true"></video>
						<canvas id="overlay" style="position: absolute; top: 0; left: 0;" width = "1200" height = "800"/>
					  </div>

					  <div id="parent2" style="float:left;">
						<br><br>
						
					  </div>
                </div>
            </div>
        </div>

        <div class="alert">
            
        </div>
    </main>


<script>
  var waitingDialog = waitingDialog || (function ($) {
    var $dialog = $(
      '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
        '<div class="modal-dialog modal-m">' +
          '<div class="modal-content">' +
          '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
          '<div class="modal-body">' +
            '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
          '</div>' +
      '</div></div></div>');

  return {
    show: function (message, options) {
      if (typeof options === 'undefined') {
        options = {};
      }
      if (typeof message === 'undefined') {
        message = 'Loading';
      }
      var settings = $.extend({
        dialogSize: 'm',
        progressType: '',
        onHide: null 
      }, options);
      $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
      $dialog.find('.progress-bar').attr('class', 'progress-bar');
      if (settings.progressType) {
        $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
      }
      $dialog.find('h3').text(message);
      if (typeof settings.onHide === 'function') {
        $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
          settings.onHide.call($dialog);
        });
      }
      $dialog.modal();
    },
    hide: function () {
      $dialog.modal('hide');
    }
  };

})(jQuery);
</script>


<script>

  //----------------------------GLOBAL VARIABLE FOR FACE MATCHER------------------------------------
  var faceMatcher = undefined
  //----------------------------------------------------------------------------------------------

  waitingDialog.show('Initializing data....', {dialogSize: 'sm', progressType: 'success'})
  $("#parent1").hide();
  $("#parent2").hide();
  Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri('/SLSU-OJT-Timesheet-Monitoring-System-using-Face-Recognation/face-recognition/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('/SLSU-OJT-Timesheet-Monitoring-System-using-Face-Recognation/face-recognition/models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('/SLSU-OJT-Timesheet-Monitoring-System-using-Face-Recognation/face-recognition/models'),
    faceapi.nets.tinyFaceDetector.loadFromUri('/SLSU-OJT-Timesheet-Monitoring-System-using-Face-Recognation/face-recognition/models')
  ]).then(start)

  async function start() {
    $.ajax({
        datatype: 'json',
        url: "http://localhost/SLSU-OJT-Timesheet-Monitoring-System-using-Face-Recognation/face-recognition/fetch.php",
        data: ""
    }).done(async function(data) {
        if(data.length > 2){
          var json_str = "{\"parent\":" + data  + "}"
          content = JSON.parse(json_str)
          for (var x = 0; x < Object.keys(content.parent).length; x++) {
            for (var y = 0; y < Object.keys(content.parent[x]._descriptors).length; y++) {
              var results = Object.values(content.parent[x]._descriptors[y])
              content.parent[x]._descriptors[y] = new Float32Array(results)
            }
          }
          faceMatcher = await createFaceMatcher(content);
		  		

        }
        waitingDialog.hide()
        $('#parent1').show()
        $('#parent2').show()        
        run();
    });
  }

  // Create Face Matcher
  async function createFaceMatcher(data) {
    const labeledFaceDescriptors = await Promise.all(data.parent.map(className => {
      const descriptors = [];
      for (var i = 0; i < className._descriptors.length; i++) {
        descriptors.push(className._descriptors[i]);
      }
      return new faceapi.LabeledFaceDescriptors(className._label, descriptors);
    }))
    return new faceapi.FaceMatcher(labeledFaceDescriptors,0.6);
  }


  async function onPlay() {
      const videoEl = $('#vidDisplay').get(0)
      if(videoEl.paused || videoEl.ended )
        return setTimeout(() => onPlay())

        $("#overlay").show()
        const canvas = $('#overlay').get(0)
        
        // if($("#register").hasClass('active'))
        // {
          const options = getFaceDetectorOptions()
          const result = await faceapi.detectSingleFace(videoEl, options)
          if (result) {
            const dims = faceapi.matchDimensions(canvas, videoEl, true)
            dims.height = 800
            dims.width = 1200
            canvas.height = 800
            canvas.width = 1200
            const resizedResult = faceapi.resizeResults(result, dims)
            faceapi.draw.drawDetections(canvas, resizedResult)  
          }     
          // else{
            // $("#overlay").hide()
          // } 
        // }

        if($("#login").hasClass('active'))
        {
          if(faceMatcher != undefined){
            //--------------------------FACE RECOGNIZE------------------
            const input = document.getElementById('vidDisplay')
            const displaySize = { width: 1200, height: 800 }
            faceapi.matchDimensions(canvas, displaySize)
            const detections = await faceapi.detectAllFaces(input).withFaceLandmarks().withFaceDescriptors()
            const resizedDetections = faceapi.resizeResults(detections, displaySize)
            const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
            results.forEach((result, i) => {
                const box = resizedDetections[i].detection.box
                const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
                drawBox.draw(canvas)
                var str = result.toString()
                rating = parseFloat(str.substring(str.indexOf('(') + 1,str.indexOf(')')))

                str = str.substring(0, str.indexOf('('))
                str = str.substring(0, str.length - 1)

                if(str != "unknown"){
                  if(rating < 0.5){
                        // if(str == $("#log_name").text()){
                            console.log("Match TRUE!")
                            match = true;
                            //$("#logname").html(str)
                            //$("#prof_img").attr('src',"http://localhost/data/" + str + "/image0.png")
                        // }
                    }  else {
                            console.log("Match FALSE!")
					}
                }
            })
            //---------------------------------------------------------------------  
          }
        }

      setTimeout(() => onPlay())
    }

  async function run() {
      const stream = await navigator.mediaDevices.getUserMedia({ video: {} })
      const videoEl = $('#vidDisplay').get(0)
      videoEl.srcObject = stream
  }
  
  // tiny_face_detector options
  let inputSize = 160
  let scoreThreshold = 0.4

  function getFaceDetectorOptions() {
    return  new faceapi.TinyFaceDetectorOptions({ inputSize, scoreThreshold });
  }

  async function load_neural(){
    waitingDialog.show('Initializing neural data....', {dialogSize: 'sm', progressType: 'success'})
    $.ajax({
        datatype: 'json',
        url: "http://localhost/SLSU-OJT-Timesheet-Monitoring-System-using-Face-Recognation/face-recognition/fetch.php",
        data: ""
    }).done(async function(data) {
        if(data.length > 2){
          var json_str = "{\"parent\":" + data  + "}"
          content = JSON.parse(json_str)
          console.log(content)
          for (var x = 0; x < Object.keys(content.parent).length; x++) {
            for (var y = 0; y < Object.keys(content.parent[x]._descriptors).length; y++) {
              var results = Object.values(content.parent[x]._descriptors[y]);
              content.parent[x]._descriptors[y] = new Float32Array(results);
            }
          }
          faceMatcher = await createFaceMatcher(content);
        }
        waitingDialog.hide()
    });
  }

</script>

<script>
  
  $(document).ready(async function(){

    var counter = 5;
    const descriptions = [];

    // -------------Initialize---------------
    $("#login").css('background-color','yellow');
    $("#login").addClass('active');
    $("#register").css('background-color','white');
    $("#register").removeClass('active');

    if($("#login").hasClass('active')){
        $("#reg_disp").hide();
        $("#log_disp").show();
    }
    else if($("#register").hasClass('active')){
        $("#reg_disp").show();
        $("#log_disp").hide();
    }
    //---------------------------------------


    $("#login").click(function(){
      $.ajax({
        datatype: 'json',
        url: "http://localhost/SLSU-OJT-Timesheet-Monitoring-System-using-Face-Recognation/face-recognition/fetch.php",
        data: ""
      }).done(function(data) {
          labeled = JSON.parse(data)
      });
      $(this).css('background-color','yellow')
      $("#register").css('background-color','white')
      $(this).addClass('active')
      $("#register").removeClass('active')
      $("#reg_disp").hide()
      $("#log_disp").show()
      $("#prof_img").removeAttr('src')
      $("#fname").val('')
      $("#lname").val('')
      $("#logname").html('')
      $("#fname").prop("readonly", false)
      $("#lname").prop("readonly", false)
      counter = 5
      description = []          
      $("#tries").html("Capture left : " + counter)        
    });

    $("#register").click(function(){
      $(this).css('background-color','yellow')
      $("#login").css('background-color','white')
      $(this).addClass('active')
      $("#login").removeClass('active')
      $("#reg_disp").show()
      $("#log_disp").hide()
      $("#prof_img").removeAttr('src')
      $("#fname").val('')
      $("#lname").val('')
      $("#logname").html('')
      $("#fname").prop("readonly", false)
      $("#lname").prop("readonly", false)      
      counter = 5
      description = []                
      $("#tries").html("Capture left : " + counter)
    });

    $("#tries").html("Capture left : " + counter)

    $("#capture").click(async function(){
      var data = $("#name").val() ;
      var id = $("#student_id").val() ;
      var stud_dprtmnt = $("#stud_dprtmnt").val() ;
      var stud_section = $("#stud_section").val() ;
      var stud_email = $("#stud_email").val() ;
      var stud_pass = $("#stud_pass").val() ;
      const label = data;

    if($("#name").val()!="") {
		// alert('test');
       // if($("#register").hasClass('active')){
      
        if(counter <= 5 && counter >= 0 ){
          var canvas = document.createElement('canvas');
          var context = canvas.getContext('2d');
          var video = document.getElementById('vidDisplay');
          context.drawImage(video, 0, 0, 600, 350);
          var capURL = canvas.toDataURL('image/png');
          var canvas2 = document.createElement('canvas');
          canvas2.width = 1200;
          canvas2.height = 800;
          var ctx = canvas2.getContext('2d');
          ctx.drawImage(video, 0, 0, 1200, 800);
          var new_image_url = canvas2.toDataURL();
          var img = document.createElement('img');
          img.src = new_image_url;
          document.getElementById("prof_img").src = img.src;

          const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
          if( detections != null){
            descriptions.push(detections.descriptor);
            var descrip = descriptions;
            counter--;
            $("#tries").html("Trials left : " + counter)
            if(counter == 0){
              // Save Image
              $.ajax({
                  type: "POST",
                  url: "http://localhost/SLSU-OJT-Timesheet-Monitoring-System-using-Face-Recognation/face-recognition/ajax.php",
                  data: {image: img.src ,path: data , id:id, stud_dprtmnt:stud_dprtmnt, stud_section:stud_section, stud_email:stud_email, stud_pass:stud_pass, api:"registerStudent"}
              }).done(function(o) {
                  console.log('Image Saved'); 
              });


              waitingDialog.show('Processing data.............', {dialogSize: 'sm', progressType: 'success'})
              var postData = new faceapi.LabeledFaceDescriptors(label, descrip);
              $.ajax({
                  url: 'json.php',
                  type: 'POST',
                  data: { myData: JSON.stringify(postData) },
                  datatype: 'json'
              })
              .done(async function (data) {
                  load_neural();
				  alert('DONE!');
				  window.location.href ='../auth.php?success';
                  waitingDialog.hide()
                  counter = 5
                  $("#tries").html("Trials left : " + counter)
                  $("#fname").val('')
                  $("#lname").val('')
                  $("#prof_img").removeAttr('src')                  
                  $("#fname").prop("readonly", false)
                  $("#lname").prop("readonly", false)
              })
              .fail(function (jqXHR, textStatus, errorThrown) { 
                  alert("Error due to internet connection! Please try again!");
              });
              const descriptions = [];
            }          
          }
          else{
            alert("No FACE detected!");
          }
        }
        else{
          alert("Done Learning!");
          counter = 5;
          const descriptions = [];
        }
      // }
    }
    else{
      if(!$("#fname").val() || !$("#fname").hasClass('active')){
        $("#fname").css('border','1px solid red');
        $("#fname").removeClass('active')      
      }
      if(!$("#lname").val() || !$("#lname").hasClass('active')){
        $("#lname").css('border','1px solid red');
        $("#lname").removeClass('active')      
      }
    }
    });

    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    
    $("#fname").keyup(function(){
      var str = $(this).val().toUpperCase();
      $(this).val(str);
      if(format.test(str) && str == ""){
        $(this).css('border','1px solid red');
        $(this).removeClass('active')
      }
      else{
        $(this).css('border','3px solid black');
        $(this).addClass('active')
      }
    });

    $("#lname").keyup(function(){
      var str = $(this).val().toUpperCase();
      $(this).val(str);
      if(format.test(str) || str == ""){
        $(this).css('border','1px solid red');
        $(this).removeClass('active')
      }
      else{
        $(this).css('border','3px solid black')
        $(this).addClass('active')   
      }
    });
});
</script>

</body>
</html>
