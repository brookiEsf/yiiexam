<?php

use yii\db\Migration;

/**
 * Class m190315_173143_products
 */
class m190315_173143_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        }
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'prod_name' => $this->string(95)->unique()->notNull(),
            'prod_definition' => $this->string(325)->notNull(),
            'price' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),

        ], $tableOptions);

        $this->batchInsert('{{%products}}', ['prod_name', 'prod_definition', 'price', 'created_at', 'updated_at'],
            [
                ['Huawei MediaPad T5 10" 3/32GB LTE Black (AGS2-L09)', 'Екран 10.1" IPS (1920x1200) MultiTouch / 
                HiSilicon Kirin 659 (2.36 ГГц + 1.7 ГГц) / RAM 3 ГБ / 32 ГБ вбудованої пам\'яті + microSD / 3G / LTE / Wi-Fi 
                / Bluetooth 4.2 / основна камера 5 Мп, фронтальна 2 Мп / GPS / ГЛОНАСС / підтримка 2 SIM-карток / Android 8.0 (EMUI) / 465 г
                 / чорний', '7499', date('y-m-d h:i:s'), date('y-m-d h:i:s')],
                ['Samsung Galaxy S10e 6/128 GB Green (SM-G970FZGDSEK)', '
Екран (5.8", Dynamic AMOLED, 2280x1080) / Samsung Exynos 9820 (2 x 2.7 ГГц + 2 x 2.3 ГГц + 4 x 1.9 ГГц) / подвійна основна камера: 12 Мп + 16 Мп / фронтальна 10 Мп / RAM 6 ГБ / 128 ГБ вбудованої пам\'яті + microSD (до 512 ГБ) / 3G / LTE / GPS / A-GPS / ГЛОНАСС / BDS / підтримка 2 SIM-карток (Nano-SIM) / Android 9.0 (Pie) / 3100 мА·год', '22499', date('y-m-d h:i:s'), date('y-m-d h:i:s')],
                ['
Ноутбук Lenovo IdeaPad 330-15ICH (81FK00G5RA) Platinum Grey', '
Екран 15.6" (1920x1080) Full HD, матовий / Intel Core i5-8300H (2.3 - 4.0 ГГц) / RAM 8 ГБ / HDD 1 ТБ / nVidia GeForce GTX 1050, 4 ГБ / без ОД / LAN / Wi-Fi / Bluetooth / веб-камера / DOS / 2.2 кг / сірий', '19999', date('y-m-d h:i:s'), date('y-m-d h:i:s')],
                ['Пральні машини LGПральна машина вузька LG F0J5NN4W', 'Тип: ВузькаМаксимальне завантаження білизни: 6 кг
                Швидкість віджимання: 1000 об/хвКлас енергоспоживання: А+++Швидкість віджимання: 1000 об/хвГабарити (ВхШхГ): 85х60х45 см
                Спосіб встановлення: Окрема (соло)Дисплей: ЄКраїна реєстрації бренду: Корея', '9999', date('y-m-d h:i:s'), date('y-m-d h:i:s')],
                ['Двокамерний холодильник ATLANT XM 6026-100', 'Колір: БілийТип холодильника: ДвокамернийКорисний об\'єм холодильної камери: 272 л
                Корисний об\'єм морозильної камери: 101 лКількість компресорів: 2Тип керування: МеханічнеГабарити (ВхШхГ): 205х60х63 смВага: 88 кг
                Країна реєстрації бренду', '15999', date('y-m-d h:i:s'), date('y-m-d h:i:s')],
                ['Крісло Примтекс Плюс Ultra C-11', 'Виготовлено в Україн  ДокладнішеДоставка у ЛуцькСамовивіз з Нової Пошти 120 грн 
                Буде передано до служби доставки завтраКур\'єр Міст Експрес 320 грн Буде передано до служби доставки завтра', '2999', date('y-m-d h:i:s'), date('y-m-d h:i:s')],
                ['Відеореєстратор Xiaomi Yi Smart Dash WiFi Gray International Edition', 'Максимальна роздільна здатність відео: SuperHD (2304x1296)
                Кількість камер: 1Вбудований GPS: НемаєЗапис звуку: ЄКраїна реєстрації бренду: Китай', '1777', date('y-m-d h:i:s'), date('y-m-d h:i:s')],
                ['Газонокосарка Daewoo DLM 1200E', 'Тип: ЕлектроПотужність: 1.2 кВтКількість рівнів висоти зрізу: 3Країна реєстрації бренду: КореяДокладніше', '2795', date('y-m-d h:i:s'), date('y-m-d h:i:s')],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m190213_184127_users cannot be reverted.\n";
        $this->dropTable('{{%products}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190315_173143_products cannot be reverted.\n";

        return false;
    }
    */
}
