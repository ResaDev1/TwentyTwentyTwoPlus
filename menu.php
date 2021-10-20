<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $result = 0;

        if (isset($_POST["checkSecondMenu"])) {
            $result = 1;
        }
        else {
            $result = 0;
        }

        match ($result) {
            0 => Db::replace(DB_TABLE, array("id" => 0, "param" => "secondMenu", "value" => "false"), array("%s", "%s")),
            1 => Db::replace(DB_TABLE, array("id" => 0, "param" => "secondMenu", "value" => "true"), array("%s", "%s")),
        };
    }

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
            bottom: 10px;
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
                            <div style="padding: 10px; display: flex; align-items: flex-end;">
                                <label for="secondmenu">
                                    فهرست دوم
                                </label>
                            </div>
                        </td>
                        <td>
                            <?php 
                                $results = Db::get("SELECT value FROM wp_tttp WHERE id=0;");

                                echo match ($results[0]->value) {
                                    "true" => '<input type="checkbox" name="checkSecondMenu" value="checked" checked>',
                                    "false" => '<input type="checkbox" name="checkSecondMenu" value="checked">'
                                };
                            ?>
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