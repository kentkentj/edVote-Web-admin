<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
            body{
                background-color: #9921e8;
                background-image: linear-gradient(315deg, #9921e8 0%, #5f72be 74%);
                font-family: 'Roboto', sans-serif;
            }
            .container-form{
                background-color: #ffffff;
                background-image: linear-gradient(315deg, #ffffff 0%, #d7e1ec 74%);
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 30%;
                -webkit-border-radius: 16px;
                -moz-border-radius: 16px;
                border-radius: 16px;
                -webkit-box-shadow: 0px 1px 15px -2px rgba(71,71,71,0.94); 
                box-shadow: 0px 1px 15px -2px rgba(71,71,71,0.94);
            }
            #subscribe-form{
                margin: 10%;
            }
            input{
                padding: 5px;
                font-size: 16px;
                width: 100%;
                height: 30px;
                border-width: 1px;
                border-color: #CCCCCC;
                background-color: #FFFFFF;
                border-style: solid;
                border-radius: 4px;
                box-shadow: -1px 0px 6px rgba(66,66,66,.29);
                text-shadow: -0.5px 0px 0px rgba(66,66,66,.75);
                color: rgba(66,66,66,.29);
            }
            input :focus{
                outline:none;
            }
            label{
                display: inline-block;
                margin-bottom: 5px;
                vertical-align: top;
                width: 100%;
            }
            .form-input{
                margin-top: 15px;
            }
            #submit{
                background-color: #9921e8;
                background-image: linear-gradient(315deg, #9921e8 0%, #5f72be 74%);
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                border: none;
                width: 100%;
                height: 40px;
                font-size: 1rem;
                font-weight: 400;
                color: #d7e1ec;
                cursor: pointer;
            }
            #message{
                padding: 20px;
                line-height: 20pt;
            }


            /* select starting stylings ------------------------------*/
            .select {
            font-family:
                'Roboto','Helvetica','Arial',sans-serif;
                position: relative;
                width: 350px;
            }

            .select-text {
                position: relative;
                font-family: inherit;
                background-color: transparent;
                width: 350px;
                padding: 10px 10px 10px 0;
                font-size: 18px;
                border-radius: 0;
                border: none;
                border-bottom: 1px solid rgba(0,0,0, 0.12);
            }

            /* Remove focus */
            .select-text:focus {
                outline: none;
                border-bottom: 1px solid rgba(0,0,0, 0);
            }

                /* Use custom arrow */
            .select .select-text {
                appearance: none;
                -webkit-appearance:none
            }

            .select:after {
                position: absolute;
                top: 18px;
                right: 10px;
                /* Styling the down arrow */
                width: 0;
                height: 0;
                padding: 0;
                content: '';
                border-left: 6px solid transparent;
                border-right: 6px solid transparent;
                border-top: 6px solid rgba(0, 0, 0, 0.12);
                pointer-events: none;
            }


            /* LABEL ======================================= */
            .select-label {
                color: rgba(0,0,0, 0.26);
                font-size: 18px;
                font-weight: normal;
                position: absolute;
                pointer-events: none;
                left: 0;
                top: 10px;
                transition: 0.2s ease all;
            }

            /* active state */
            .select-text:focus ~ .select-label, .select-text:valid ~ .select-label {
                color: #2F80ED;
                top: -20px;
                transition: 0.2s ease all;
                font-size: 14px;
            }

            /* BOTTOM BARS ================================= */
            .select-bar {
                position: relative;
                display: block;
                width: 350px;
            }

            .select-bar:before, .select-bar:after {
                content: '';
                height: 2px;
                width: 0;
                bottom: 1px;
                position: absolute;
                background: #2F80ED;
                transition: 0.2s ease all;
            }

            .select-bar:before {
                left: 50%;
            }

            .select-bar:after {
                right: 50%;
            }

            /* active state */
            .select-text:focus ~ .select-bar:before, .select-text:focus ~ .select-bar:after {
                width: 50%;
            }

            /* HIGHLIGHTER ================================== */
            .select-highlight {
                position: absolute;
                height: 60%;
                width: 100px;
                top: 25%;
                left: 0;
                pointer-events: none;
                opacity: 0.5;
            }
        </style>
        <title>PHP Form Demo</title>
    </head>
    <body>
        <main class="container-form">
            <form id="subscribe-form" action="<?php htmlspecialchars_decode($_SERVER['PHP_SELF']) ?>" method="POST">
                <!--<div class="form-input">
                    <label for="name">Name:</label>
                    <input type="text" name="name" required="required" placeholder="Enter your name" />
                </div>

                <div class="form-input">
                    <label for="name">Email:</label>
                    <input type="email" name="email" required="required" placeholder="Enter your email" />
                </div>-->
                <h2>Install Edvote Database</h2>

                <?php
                    if(isset($_POST["install"])){
                        $dbInstallDropdown = $_POST["dbInstallDropdown"];
                        switch ($dbInstallDropdown) {
                            case 'createDb':
                                echo 'Install Database';
                                break;
                            
                            case 'createDepartmentTable':
                                echo 'Install Department table';
                                break;

                            case 'createUserTable':
                                echo 'Install User table';
                                break;
                            default:
                                echo 'Please Select to Install';
                                break;
                        }
                    }
                ?>
                <div class="select" style="margin-top:30px">
					<select class="select-text" required name="dbInstallDropdown">
						<option value="" disabled selected></option>
						<option value="createDb">Install Database</option>
						<option value="createDepartmentTable">Install Department table</option>
						<option value="createUserTable">Install User table</option>
					</select>
					<span class="select-highlight"></span>
					<span class="select-bar"></span>
					<label class="select-label">Select SQl Query to Install</label>
				</div>
                <div class="form-input">
                    <button id="submit" type="submit" name="install">Install</button>
                </div>
            </form>
        </main>
    </body>
</html>