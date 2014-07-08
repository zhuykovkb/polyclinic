<h1><?php echo $record['name'] ?></h1>

<?php if (!empty($record['photo'])) { ?>
    <img src="<?php echo "{$config['imagedir']}/{$record['photo']}" ?>">
    <br/>
<?php } ?>

<?php if (!empty($record['history'])) { ?>
    <h2>History: </h2>
    <br/>
    <p><?php echo $record['history'] ?></p>
<?php } ?>

<h3>Patient card number: <?php echo $record['card_num'] ?></h3>

<?php if (!empty($record['email'])) { ?>
    <p>E-mail: <?php echo $record['email'] ?></p>
<?php } ?>

<p>Sex: <?php echo $record['sex'] ?></p>

<?php if (!empty($record['insurance_num'])) { ?>
    <p>Insurance number: <?php echo $record['insurance_num'] ?></p>
<?php } ?>

<p>Native city id: <?php echo $record['native_city_id'] ?></p>