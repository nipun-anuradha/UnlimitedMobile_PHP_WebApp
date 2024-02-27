<?php
require "../source/connection.php";

$s_txt = $_POST["s"];

$users_rs = Database::search("SELECT * FROM `user` WHERE fname LIKE '$s_txt%' OR lname LIKE '$s_txt%' OR mobile LIKE '$s_txt%' OR email LIKE '$s_txt%' ");

$num = $users_rs->num_rows;

for ($u = 0; $u < $num; $u++) {
    $user = $users_rs->fetch_assoc();

?>

    <tr>
        <td class="min-width">
            <div class="lead">
                <div class="lead-image">
                    <img src="../img/usericon.jpg" />
                </div>
                <div class="lead-text">
                    <p><?php echo $user["email"]; ?></p>
                </div>
            </div>
        </td>
        <td class="min-width">
            <p><a href="#0"><?php echo $user["fname"];; ?></a></p>
        </td>
        <td class="min-width">
            <p><?php echo $user["lname"];; ?></p>
        </td>
        <td>
            <p><?php echo $user["mobile"]; ?></p>
        </td>
        <td class="min-width">
            <p><?php echo $user["joined_date"]; ?></p>
        </td>
        <td>
            <div class="action">
                <?php
                if ($user["status_id"] == '1') {
                ?>
                    <button class="text-success" id="c<?php echo $user['email']; ?>" onclick="blockUser('<?php echo $user['email']; ?>');">
                        <i class="lni lni-unlock" id="i<?php echo $user['email']; ?>"></i>
                    </button>
                <?php
                } else {
                ?>
                    <button class="text-danger" id="c<?php echo $user['email']; ?>" onclick="blockUser('<?php echo $user['email']; ?>');">
                        <i class="lni lni-lock" id="i<?php echo $user['email']; ?>"></i>
                    </button>
                <?php
                }
                ?>
                <button class="text-black">
                    <i class="lni lni-pencil-alt"></i>
                </button>
            </div>
        </td>
    </tr>

<?php
}








?>