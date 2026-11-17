<?php
/**
 * Email Configuration
 * 
 * Using hosting provider's SMTP server
 * Sends emails from info@vaanakam.lk
 * 
 * NOTE: When running on cPanel (production), use 'localhost' as MAIL_HOST
 * since the mail server is on the same server. This avoids DNS/SSL issues.
 * If sending from external server, use 'vaanakam.lk' or 'mail.vaanakam.lk'
 */

define('MAIL_HOST', 'localhost');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'info@vaanakam.lk');
define('MAIL_PASSWORD', 'osloCC@123');
define('MAIL_FROM_EMAIL', 'info@vaanakam.lk');
define('MAIL_FROM_NAME', 'VAANAKAM');
define('MAIL_ENCRYPTION', ''); // Empty = auto-detect (SMTPAutoTLS will try TLS if available)
