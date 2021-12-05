<?php
    include '../config.php';
    session_start();
    global $conn, $output;
?>
<div class="chatBox">
    <ul class="companies">
       <?php
          $query = "Select * from supervisor where personnel = '".$_SESSION['user_id']."'";
          $result = mysqli_query($conn, $query);

          while ($companies = mysqli_fetch_array($result)){
            $output.='
                <li class="">'.$companies['company'].'</li>
            ';
          }
          echo $output;
       ?>
    </ul>
    <div class="chat">
          <div class="chat_history">
             <div class="company_name">
                <svg style="position: relative;top: -2px;" class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path></svg>
                <span>DOLE-R07</span>
             </div>
             <div class="chat_contents">
                   <li style="padding:8px 10px; background-color:#116BCA; border-radius:5px; width:30%; color:#FFFFFF;margin-bottom:5px;">Good morning everyone.</li>
                   <small >Geraldine Mangmang, Send on <?php echo date('F j, Y');?></small>
             </div>
          </div>
          <div class="chat_message">
              <div class="message" contenteditable>

              </div>
              <div class="send_button">
                    <button>Send Message</button>
              </div>
          </div>
    </div>
</div>