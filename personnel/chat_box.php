 <?php
    error_reporting(0);
    include '../config.php';
    session_start();
    global $conn, $output;
?>
 <div class="chat_history">
             <div class="company_name">
                <svg style="position: relative;top: -2px;" class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path></svg>
                <span><?php echo $_GET['company'];?></span>
             </div>
			
			  <div class="chat_contents">
			   <?php
				$company = $_GET['company'];
				$query   = "select * from chat where company='$company' order by chat_id desc";
				$result  = mysqli_query($conn, $query);
				while($fetch = mysqli_fetch_array($result)){                        
			 
			 ?>
                  	<?php if($fetch[5] == 2){ ?>
					<li style="padding:8px 10px; background-color:#778899; border-radius:5px; width:30%; color:#FFFFFF;margin-bottom:1px;"><?php echo $fetch[3];?></li>
					<?php } else { ?>
					<li style="padding:8px 10px; background-color:#116BCA; border-radius:5px; width:30%; color:#FFFFFF;margin-bottom:1px;"><?php echo $fetch[3];?></li>
					<?php } ?>
                   <small> <?php echo $fetch[2];?> , Send on <?php $date = new DateTime($fetch[4]);
																	echo $date->format('F d Y, H:i:s');;?></small>
				   <br>
				   <br>
				<?php } ?>

             </div>
          </div>
          <div class="chat_message">
              <div class="message" contenteditable>

              </div>
              <div class="send_button">
					<input type="hidden" id="company_chat" value="<?php echo $_GET['company'];?>">
					<input type="hidden" id="user_name" value="<?php echo $_SESSION['user_name'];?>">
                    <button type="submit" id="chat_send_message">Send Message</button>
              </div>
</div>
		  
<script>
$('#chat_send_message').click(function(){
        var message = $(".message").text();
       	var company_chat = $("#company_chat").val();
       	var user_name = $("#user_name").val();
		$.ajax({
        url:'api/api.php',
        method:'POST',
        cache:false,
        data:{
			api:"send_chat",
            message:message,
            company_chat:company_chat,
            user_name:user_name,
			chat_type:1,

        },
        success:function(data){
			$("#btn_OJT_Coordinator_Chat").trigger('click');
			 $.ajax({
				url:'personnel/chat_box.php',
				method:'GET',
				 data:{
						company:company_chat,
					},
				cache:false,
				beforeSend:function(){
					
					$('.chat').html('');
					$('#loader').addClass('load');
				},
				success:function(data){
					$("#company_chat1").val(company_chat);
					$('.chat').html(data);
				},
				complete:function(){
					$('#loader').removeClass('load');
				}
        })
        }
       })
});
</script>