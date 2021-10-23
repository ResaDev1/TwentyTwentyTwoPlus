<?php
    /**
     * Set OR replace boolean to db
     * @since 0.0.2
     * @return void
     */
    function set_bool(string $param) {
        $data = Db::get("SELECT value FROM wp_tttp WHERE param='$param';");
        // If data exists
        if ($data) {
            $value = isset($_POST["$param"]);
            Db::update(DB_TABLE, array("value" => $value), array("param" => $param));
        }
        else {
            Db::insert(DB_TABLE, array("param" => $param, "value" => ""), array("%s", "%s"));
        }
    }

    /**
     * Get boolean from db
     * @since 0.0.2
     * @return string
     */
    function get_bool(string $param): string {
        $result = Db::get("SELECT value FROM wp_tttp WHERE param='$param';");

        if ($result) {
            return match ($result[0]->value) {
                "1"  => 'checked',
                "" => '',
            };
        }
        else {
            return '';
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        set_bool("checkSecondMenu");
        set_bool("darkMode");
    }

    $second_menu = get_bool("checkSecondMenu");
    $dark_mode = get_bool("darkMode");
?>

<html>
    <style>
        .hidden {
            display: none;
        }

		main form {
		    display: flex;
		    flex-direction: column;
            align-items: baseline;
            margin-top: 1rem;
		}

        input[type=submit] {
            background: none;
            border: 1px solid #a0a0a0;
            padding: 6px;
            cursor: pointer;
        }

        table {
            border: solid 1px #a0a0a0;
            background: #fff;
        }

        table, td {
            text-align: center;
            width: 20rem;
        }

        th {
            border-bottom: solid 1px #a0a0a0;
        }

        .tttp-bottom-section {
            position: fixed;
            bottom: 3rem;
        }

        hr {
            margin-bottom: 2rem;
            margin-top: 2rem;
        }
    </style>

    <main>
        <h1>تنظیمات افزونه</h1>
        
        <form method="POST" action="">
            <table>
                <thead>
                    <tr>
                        <th>پارامتر</th>
                        <th>مقدار</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            فهرست دوم
                        </td>
                        <td>
                            <input type="checkbox" name="checkSecondMenu" value="checked" <?= $second_menu ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            حالت تاریک
                        </td>
                        <td>
                            <input type="checkbox" name="darkMode" value="checked" <?= $dark_mode ?>>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="ثبت تغییرات" class="button" style="margin-top: 1rem;">
        </form>
        
    </main>
    <hr>
    <div class="tttp-bottom-section">
        <p>نسخه : <?php echo get_plugin_version(); ?></p>
        <button onclick="toggleLogs()">Logs</button>
    </div>

    
    <textarea name="Logs" id="Logs" cols="60" rows="10" dir="ltr" class="hidden">
        <?php
            $messages = get_logs();
            foreach ($messages as $message) {
                echo $message . "\n";
            }
        ?>
    </textarea>
    <script>
        function toggleLogs() {
            document.getElementById("Logs").classList.toggle('hidden');
        }
    </script>
</html>