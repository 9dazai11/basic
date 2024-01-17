<?php

/** @var yii\web\View $this */

$this->title = 'Поликлиника "ЗаботаЗдоровья"';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Поликлиника "ЗаботаЗдоровья" - ваш путь к здоровью!</h1>

        <p class="lead">Мы обеспечиваем высококачественное медицинское обслуживание и заботимся о каждом пациенте.</p>

        <!-- <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p> -->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Наш медицинский состав</h2>

                <p>
                    В поликлинике действует 13 терапевтических участков, где трудятся 10 врачей-терапевтов педиатров.
                    Обслуживание пациентов осуществляется с учетом территориального принципа и прикрепления.
                    Помимо врачей-терапевтов и педиатров, прием проводят и другие врачи-специалисты.
                    Чтобы ознакомиться с их специализацией, вы можете нажать на кнопку ниже.
                    Там же представлена информация о наших врачах.
                </p>

                <?= \yii\helpers\Html::a('Специализации врачей', ['/professions'], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Наши услуги</h2>

                <p>
                    Мы предоставляем широкий спектр медицинских услуг, включая диагностику, лечение и профилактику
                    различных
                    заболеваний. Наши врачи стремятся обеспечить высококачественное и индивидуальное обслуживание
                    каждого
                    пациента. Мы гордимся нашим профессионализмом и заботой о вашем здоровье.</p>

                <?= \yii\helpers\Html::a('Узнать больше о наших услугах', ['site/services'], ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Время работы и контакты</h2>
                <p>
                    <strong>Время работы:</strong><br>
                    Пн-Пт: 7:00 - 18:00<br>
                    Сб: 8:00 - 14:00<br>
                    Вс: Выходной<br>
                    В субботу работает только неотложная помощь.
                </p>
                <p>
                    <strong>Контакты:</strong><br>
                    <strong>Адрес:</strong> ул. Здоровая, дом 123<br>
                    <strong>Телефон:</strong> +7 (123) 456-7890<br>
                    <strong>Почта:</strong> info@example.com
                </p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12 text-center">
                <a href="https://www.admkirov.ru/" target="_blank"><img src="/images/admkirov_image.jpg"
                        alt="Администрация г. Киров" class="img-fluid"></a>
                <a href="https://www.kirovreg.ru/" target="_blank"><img src="/images/kirovreg_image.jpg"
                        alt="Кировская областная администрация" class="img-fluid"></a>
                <a href="https://medkirov.ru/" target="_blank"><img src="/images/medkirov_image.jpg"
                        alt="Медицинский центр Киров" class="img-fluid"></a>
                <a href="http://kotfoms.kirov.ru/" target="_blank"><img src="/images/kotfoms_image.jpg"
                        alt="Кировская областная территориальная фонд социального страхования" class="img-fluid"></a>
                <a href="https://rospotrebnadzor.ru/" target="_blank"><img src="/images/rospotrebnadzor_image.jpg"
                        alt="Роспотребнадзор" class="img-fluid"></a>
            </div>
        </div>

    </div>
</div>