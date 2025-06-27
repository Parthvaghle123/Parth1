<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) { // Fixed the name to match HTML form button (no space)
        if (isset($_SESSION['cart'])) {
            $myitems = array_column($_SESSION['cart'], 'Item_Name');
            if (in_array($_POST['Item_Name'], $myitems)) {
                echo "
                    <script>
                        alert('Item already added');
                        window.location.href='index.php';
                    </script>
                ";
                exit;
            } else {
                $count = count($_SESSION["cart"]);
                $_SESSION["cart"][$count] = array(
                    'Item_Name' => $_POST['Item_Name'],
                    'Price' => $_POST['Price'],
                    'Quantity' => 1
                );
                echo "
                    <script>
                        alert('Item added');
                        window.location.href='index.php';
                    </script>
                ";
                exit;
            }
        } else {
            $_SESSION['cart'][0] = array(
                'Item_Name' => $_POST['Item_Name'],
                'Price' => $_POST['Price'],
                'Quantity' => 1
            );
            echo "
                <script>
                    alert('Item added');
                    window.location.href='index.php';
                </script>
            ";
            exit;
        }
    }
    if (isset($_POST["Remove_Item"])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['Item_Name'] == $_POST['Item_Name']) {
                unset($_SESSION['cart'][$key]);
                // Reindex array
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo "
                    <script>
                       
                        window.location.href='mycart.php';
                    </script>
                ";
                break; // Once item is removed, no need to continue loop
            }
        }
    }
    if (isset($_POST["Mod_Quantity"]) && isset($_POST["Item_Name"])) {
        foreach ($_SESSION["cart"] as $key => $value) {
            if ($value["Item_Name"] == $_POST["Item_Name"]) {
                $_SESSION['cart'][$key]['Quantity'] = $_POST['Mod_Quantity'];
                break; // મળી ગયું એટલે લૂપથી બહાર નીકળો
            }
        }
        echo "
            <script>
                window.location.href='mycart.php';
            </script>
        ";
    }
    
}
?>