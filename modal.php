<?php   
        include 'config/db_connect_arte.php';

         include 'config/get_service.php'; 
?>
<div id="booking-modal" class="modal">
    <a href="#" class="close">×</a>
    <h2>Book an Appointment</h2>

    <div class="modal-content">

        <form method="POST" action="">
           
            <div class="form-group">
                <input type="text" id="firstname" name="firstname" required placeholder=" " pattern="^[A-Za-z]+$" title="Please enter name"  />
                <label for="firstname">Firstname:</label>
            </div>
            
            <div class="form-group">
                <input type="text" id="lastname" name="lastname" required placeholder=" " pattern="^[A-Za-z]+$" title="Please enter name" />
                <label for="lastname">Lastname:</label>
            </div>

       

            <div class="form-group">
                <input type="text" id="phone" name="phone" required placeholder=" "pattern="^09\d{8,9}$" title="Enter 11 degits and start 09"  />
                <label for="phone">Contact:</label>
            </div>
            

            <div class="form-group">
                <input type="date" id="appointment_date" name="appointment_date" required placeholder=" " min="2025-01-01" max="2025-12-31"/>
                <label for="appointment_date">Appointment Date:</label>
            </div>

            <div class="form-group">
                <input type="time" id="appointment_time" name="appointment_time" required placeholder=" " min="09:00" max="18:00" />
                <label for="appointment_time">Appointment Time:</label>
            </div>



            <div class="form-group service">
                <select id="service" name="service" required>
                    <option value="">Select a service</option>
                    <?php foreach ($services as $service): ?>
                        <option value="<?php echo ($service['srv_name']); ?>">
                            <?php echo ($service['srv_name']) . " - ₱" . number_format($service['srv_price'], 2); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mess">
                <input type="text" id="message" name="message"  placeholder=" " />
                <label for="message">Message:</label>
            </div>

            <button type="submit" name="review">Review & Confirm</button>
        </form>
    </div>
</div>

<!-- C -->
<?php if (isset($_GET["review"]) && isset($_SESSION["booking_details"])): ?>

    <div id="review-modal" class="modal" style="opacity: 1; visibility: visible;">

        <div class="modal-content">
            <a href="<?php echo $_SERVER["PHP_SELF"]; ?>" class="close">&times;</a>


     <table>
            <h2>Review Your Appointment</h2>
              </p>

                    <tr>
                        <th>
                             <strong>Full Name:</strong>
                        </th>
                        <td>
                        <?php echo $_SESSION["booking_details"]["firstname"] ?? 'N/A'; ?>, 
                        <?php echo $_SESSION["booking_details"]["lastname"] ?? 'N/A'; ?>
                      </td>
                    </tr>
                
                    <tr>
                        <th>
                             <strong>Contact:</strong>
                        </th>
                        <td>
                        <?php echo $_SESSION["booking_details"]["phone"] ?? 'N/A'; ?>, 
                      </td>
                    </tr>
                    <tr>
                        <th>
                             <strong>Service Type:</strong>
                        </th>
                        <td>
                        <?php echo $_SESSION["booking_details"]["srv_type"] ?? 'N/A'; ?>, 
                      </td>
                    </tr>
                    <tr>
                        <th>
                             <strong>Service Name:</strong>
                        </th>
                        <td>
                        <?php echo $_SESSION["booking_details"]["service"] ?? 'N/A'; ?>, 
                      </td>
                    </tr>
                    <tr>
                        <th>
                             <strong>Price:</strong>
                        </th>
                        <td>
                        <?php echo $_SESSION["booking_details"]["srv_price"] ?? 'N/A'; ?>, 
                      </td>
                    </tr>
                    <tr>
                        <th>
                             <strong>Appointment:</strong>
                        </th>
                        <td>
                        <b>Date: </b> <?php echo $_SESSION["booking_details"]["appointment_date"] ?? 'N/A'; ?> 
                         
                      </td>
                    </tr>
                    <tr>
                        <th>
                          
                        </th>
                        <td>
                        <b>Time: </b> <?php echo $_SESSION["booking_details"]["appointment_date"] ?? 'N/A'; ?>
                         
                      </td>
                    </tr>
                    <tr>
                        <th>
                             <strong>Message:</strong>
                        </th>
                        <td>
                         <?php echo $_SESSION["booking_details"]["message"] ?? 'N/A'; ?> :
                         
                       </td>
                    </tr>
             </table>


      
            <form method="POST" action="http://localhost/Arte_Project/pages/booking_process.php">

                <?php foreach ($_SESSION["booking_details"] as $key => $value): ?>
                    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
                <?php endforeach; ?>

                <button type="submit">Confirm & Submit</button>

            </form>
   
            <a class="btn-edit" href="#booking-modal" onclick="history.back()"; >Edit Appointment</a>
        </div>
    </div>
    
    <?php unset($_SESSION["booking_details"]); // Clear session after displaying ?>
<?php endif; ?>

