<?php
declare(strict_types=1);

use App\models\LengthContentModel;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = include __DIR__ . '/app/config/config.php';

$model = new LengthContentModel();

$dataMaria = $model->getDataMariDb();
$dataClickHouse = $model->getDataClickHouse();

print_r($dataMaria);
print_r($dataClickHouse);

// Не стал отрисовывать таблицу так как не смог получить `средняя длина контента`
//- `время первого и последнего сообщения в минуте`
