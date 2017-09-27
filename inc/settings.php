<?php

final class Settings {
    public static $TRUE = "1", $FALSE = "0";

    public function __construct($connect = true) {
        // Web interface language. Languages are stored in the "lang/" directory.
        $this->lang = 'en_US.utf8';

        // Database information
        $this->host = 'localhost';
        $this->port = 3306;

        $database = 'litebans';

        $username = '';
        $password = '';

        // If you set a table prefix in config.yml, set it here as well
        $this->table_prefix = "litebans_";

        // Supported drivers: mysql, pgsql
        $driver = 'mysql';

        // Server name, shown on the main page and on the header
        $this->name = 'LiteBans';

        // Clicking on the header name will send you to this address.
        $this->name_link = '#';




        // Start of information added for GlareMaster's Litebans Addon

        // Set your server IP for the Player's Online
        $this->server_ip = 'mc.hypixel.net';
        
        // Would you like to show your navigation bar? (This is a custom change that you can do if you want to iframe your site
        // onto another site such as XenForo). (Keep in mind, this will also remove the user from being able to change themes, as it hides the theme changer).
        $this->show_navigation = true;
        
        // This setting can go along with the option above if you want it to. If you choose to remove the navigation bar, you can also make a search button display on the main home page if you want to only allow users to view by searched user names.
        $this->show_main_page_search_button = false;

        // Put the image URL of your logo here
        $this->logo_image = 'https://via.placeholder.com/275x150';

        // Clicking on the "Contact Us" button will send you to this address.
        $this->contact_link = '#';

        // Clicking on the "Ban Appeal" button will send you to this address.
        $this->appeal_link = '#';
        
        // Would you like to display the social media icons on the page?
        $this->show_social = true;
        
        // Would you like to display the theme changer to your users?
        $this->show_theme_changer = true;

        // Clicking on the YouTube Icon will send you to this address.
        $this->youtube_link = '#';

        // Clicking on the Twitter Icon will send you to this address.
        $this->twitter_link = '#';

        // Clicking on the Facebook Icon will send you to this address.
        $this->facebook_link = '#';

        // Clicking on the Google Plus Icon will send you to this address.
        $this->googleplus_link = '#';

        // Modify this for your SEO (Search Engine Optimization)

        $this->meta_title = 'LiteBans Material Design Theme (Multiple Themes Included)';
        $this->meta_description = 'Welcome to our Litebans Web Interface! You can see our bans, mutes, warns, and kicks!';
        $this->meta_keywords ='minecraft,bans,spigot,litebans,material,design';
        $this->meta_image ='https://www.spigotmc.org/data/avatars/l/64/64823.jpg?1496878424';

        // End of information added for GlareMaster's Litebans Addon




        // Show inactive bans? Removed bans will show (Unbanned), mutes will show (Unmuted), warnings will show (Expired).
        $this->show_inactive_bans = true;

        // Show pager? This allows users to page through the list of bans.
        $this->show_pager = true;

        // Amount of bans/mutes/warnings to show on each page
        $this->limit_per_page = 10;

        // The server console will be identified by any of these names.
        // It will be given a standard name and avatar image.
        $this->console_aliases = array(
            "CONSOLE", "Console",
        );
        $this->console_name = "Console";
        $this->console_image = "inc/img/console.png";

        // Avatar images for all players will be fetched from this URL.
        // Examples:
        /* 'https://cravatar.eu/avatar/$UUID/25'
         * 'https://crafatar.com/avatars/$UUID?size=25'
         * 'https://minotar.net/avatar/$NAME/25'
         */
        $this->avatar_source = 'https://crafatar.com/avatars/$UUID?size=25';

        // If enabled, names will be shown below avatars instead of being shown next to them.
        $this->avatar_names_below = true;

        // If enabled, the total amount of bans, mutes, warnings, and kicks will be shown next to the buttons in the header.
        $this->header_show_totals = true;

        // The date format can be changed here.
        // https://secure.php.net/manual/en/function.strftime.php
        // Example output of default format: July 2, 2015, 09:19; August 4, 2016, 18:37
        $this->date_format = '%B %d, %Y, %H:%M';

        // https://secure.php.net/manual/en/timezones.php
        $timezone = "UTC";

        // Enable PHP error reporting.
        // Prefer "false" on production stage
        $this->error_reporting = false;

        // Enable error pages.
        $this->error_pages = true;

        $this->date_month_translations = null;

        /*
        $this->date_month_translations = array(
            "January"   => "Month 1",
            "February"  => "Month 2",
            "March"     => "Month 3",
            "April"     => "Month 4",
            "May"       => "Month 5",
            "June"      => "Month 6",
            "July"      => "Month 7",
            "August"    => "Month 8",
            "September" => "Month 9",
            "October"   => "Month 10",
            "November"  => "Month 11",
            "December"  => "Month 12",
        );
        */

        /*** End of configuration ***/


        /** Don't modify anything here unless you know what you're doing **/

        if ($this->error_reporting) {
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
        }

        $this->active_query = "";

        if ($driver === "pgsql") {
            Settings::$TRUE = "B'1'";
            Settings::$FALSE = "B'0'";
        }

        if (!$this->show_inactive_bans) {
            $this->active_query = "WHERE active=" . Settings::$TRUE;
        }


        // test strftime

        date_default_timezone_set("UTC"); // temporarily set UTC timezone for testing purposes

        $fail = false;
        $test = strftime($this->date_format, 0);
        if ($test == false) {
            ob_start();
            var_dump($test);
            $testdump = ob_get_clean();
            echo("Error: date_format test failed. strftime(\"" . $this->date_format . "\",0) returned " . $testdump);
            $fail = true;
        }

        $test = strftime("%Y-%m-%d %H:%M", 0);
        if ($test !== "1970-01-01 00:00") {
            ob_start();
            var_dump($test);
            $testdump = ob_get_clean();
            echo("Assertion failed: strftime(\"%Y-%m-%d %H:%M\",0) != \"1970-01-01 00:00\"<br>");
            echo("Actual result: " . $testdump);
            $fail = true;
        }

        if ($fail === true) {
            die;
        }

        date_default_timezone_set($timezone); // set configured timezone

        $table_prefix = $this->table_prefix;

        // Internal table names, do not translate.
        $this->table = array(
            'bans'     => "${table_prefix}bans",
            'mutes'    => "${table_prefix}mutes",
            'warnings' => "${table_prefix}warnings",
            'kicks'    => "${table_prefix}kicks",
            'history'  => "${table_prefix}history",
            'servers'  => "${table_prefix}servers",
        );

        $this->driver = $driver;
        if ($connect) {
            if ($username === "" && $password === "") {
                $this->redirect("error/unconfigured.php");
            }
            $host = $this->host;
            $port = $this->port;

            $dsn = "$driver:dbname=$database;host=$host;port=$port";
            if ($driver === 'mysql') {
                $dsn .= ';charset=utf8';
            }

            $options = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            );

            try {
                $this->conn = new PDO($dsn, $username, $password, $options);

                $st = $this->conn->query("SELECT * FROM " . $this->table['servers'] . " LIMIT 1;");
                $st->fetch();
                $st->closeCursor();
            } catch (PDOException $e) {
                Settings::handle_error($this, $e);
            }
            if ($driver === 'pgsql') {
                $this->conn->query("SET NAMES 'UTF8';");
            }
        }
    }


    /**
     * @param $settings Settings
     * @param $e Exception
     */
    static function handle_error($settings, $e) {
        $message = $e->getMessage();
        if ($settings->error_pages) {
            if (strstr($message, "Access denied for user")) {
                if ($settings->error_reporting) {
                    $settings->redirect("error/access-denied.php?error=" . base64_encode($message));
                } else {
                    $settings->redirect("error/access-denied.php");
                }
            }
            if (strstr($message, "Base table or view not found:")) {
                $settings->redirect("error/tables-not-found.php");
            }
            if (strstr($message, "Unknown column")) {
                $settings->redirect("error/outdated-plugin.php");
            }
        }
        if ($settings->error_reporting === false) {
            die("Database error");
        }
        die('Database error: ' . $message);
    }


    function redirect($url, $showtext = true) {
        if ($showtext === true) {
            echo "<a href=\"$url\">Redirecting...</a>";
        }
        echo "<script data-cfasync=\"false\" type=\"text/javascript\">document.location=\"$url\";</script>";
        die;
    }
}
