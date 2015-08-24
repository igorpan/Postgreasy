<!DOCTYPE html>
<html>
<head></head>
<body>
    <h1>Databases</h1>

    <?php foreach($manager->getSchemas() as $schema) { ?>
        <h2><?php echo $schema->getName() ?></h2>
        <?php foreach($schema->getTables() as $table) { ?>
            <h3><?php echo $table->getName() ?></h3>
            <?php echo join(', ', $table->getColumns()) ?>
        <?php } ?>
    <?php } ?>
</body>
</html>