
<h1>Patients List</h1>

<?php if (count($list)) { ?>
    <ul>
        <?php foreach ($list as $patient) { ?>
            <li>
                <?php echo "{$patient['name']} ({$patient['sex']}) E-mail: {$patient['email']}" ?>
                <br/>
                <?php echo "Card: #{$patient['card_num']}" ?>
            </li>

            <?php echo $patient['history'] ?>

            <a href="?action=show&patientId=<?php echo $patient['id'] ?>">Show</a>
            <a href="?action=edit&patientId=<?php echo $patient['id'] ?>">Edit</a>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p>No rows returned</p>
<?php }