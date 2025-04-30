<?php

    define('ERROR_NO_SENDMAIL', 'c_e1');    
    
    class SendMail
    {
        public static function RegistrationValidation($username, $email, $validationLink)
        {
            $message = sprintf
            (' 
                <html>
                    <body>
                        <h2>LH Fusion Email Verification</h2>
                        <hr />
                        Dear %s,<br />
                        Your account is almost ready to be used. To complete your account registration we need to verify that this email address actually exists.<br />Please click the link below to verify your email address and complete the registration of your account.<br /><br />
                        <a href="%s">%s</a>
                        <br /><br />Regards,<br />LHFusion Team
                    </body>
                </html>

            ', $username, $validationLink, $validationLink);

            if(self::Send($email, 'LHFusion Email Verification', $message))
                return true;

            return false;        
        }

        public static function RegistrationComplete($username, $password, $email, $securitycode)
        {
            $message = sprintf
            ("
                <html>
                    <body>
                        <h2>LHFusion Account Registration</h2>
                        <hr />
                        Dear %s,<br />
                        You have registered a game account for LHFusion.<br />To make sure u will not forget your account details u receive this e-mail.<br />Please note that your security code can not be changed or requested later.
                        <ul>
                            <li><b>Username: </b>%s</li>
                            <li><b>Password: </b>%s</li>
                            <li><b>Email: </b>%s</li>
                            <li><b>Security Pincode: </b>%s</li>
                        </ul>	
                        <br /><br />Regards,<br />LHFusion Team
                    </body>
                </html>

            ", $username, $username, $password, $email, $securitycode);

            if(self::Send($email, 'LHFusion Account Registration', $message))
                return true;

            return false;

        }
        

        public static function ChangeEMailValidation($username, $email, $validationLink)
        {
            $message = sprintf
            (' 
                <html>
                    <body>
                        <h2>LHFusion Email Change Verification</h2>
                        <hr />
                        Dear %s,<br />
                        You have chosen to change the email assigned to your game account.<br />To complete your request we need to verify that this email address actually exists.<br />Please click the link below to verify your email address.<br /><br />
                        <a href="%s">%s</a>
                        <br /><br />Regards,<br />LHFusion Team
                    </body>
                </html>

            ', $username, $validationLink, $validationLink);

            if(self::Send($email, 'LHFusion Email Verification', $message))
                return true;

            return false;        
        } 
        
        public static function PasswordChangedEmail($username, $email, $password)
        {
            $message = sprintf
            ("
                <html>
                    <body>
                        <h2>LHFusion Password Change</h2>
                        <hr />
                        Dear %s,<br />
                        You have changed the password of your game account.<br />To make sure u will not forget your account details u receive this e-mail.
                        <ul>
                            <li><b>Username: </b>%s</li>
                            <li><b>Password: </b>%s</li>
                            <li><b>Email: </b>%s</li>
                        </ul>	
                        <br /><br />Regards,<br />LHFusion Team
                    </body>
                </html>

            ", $username, $username, $password, $email);

            if(self::Send($email, 'LHFusion Password Change Notification', $message))
                return true;

            return false;             
        }
        
        public static function LostPasswordEmail($username, $email, $link)
        {
            $message = sprintf
            ('
                <html>
                    <body>
                        <h2>LHFusion Lost Password</h2>
                        <hr />
                        Dear %s,<br />
                        You receive this e-mail because you have requested to recover your password on the website.<br />
                        Please click the link below to verify your email address.<br />
                        If you did not request your password just ignore this email.
                        <br /><br /><a href="%s">%s</a>
                    </body>
                </html>

            ', $username, $link, $link);
            
            if(self::Send($email, 'LHFusion Password Recovery', $message))
                return true;

            return false;              
        }

        private static function Send($to, $subject, $message) {
            $headers = "From: laghaimfusion@gmail.com\r\n";
            $headers .= "Reply-To: laghaimfusion@gmail.com\r\n";
            $headers .= "Return-Path: laghaimfusion@gmail.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
            if(mail($to, $subject, $message, $headers)) {
                return "E-mail enviado com sucesso.";
            } else {
                error_log("Erro ao enviar e-mail para $to");
                return "Falha ao enviar o e-mail.";
            }
        }
        


    }
