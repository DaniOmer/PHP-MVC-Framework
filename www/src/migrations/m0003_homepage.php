<?php

/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/migrations/m0003_homepage.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

use App\core\Application;
 
class m0003_homepage
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = '
            DROP TABLE IF EXISTS esgi_homepage;
            DROP SEQUENCE IF EXISTS esgi_homepage_id_seq;
            CREATE SEQUENCE esgi_homepage_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

            CREATE TABLE public.esgi_homepage (
                id integer DEFAULT nextval(\'esgi_homepage_id_seq\') NOT NULL,
                page_id integer NOT NULL,
                banner_link character varying(350) NOT NULL,
                banner_text character varying(700) NOT NULL,
                content text NOT NULL,
                date_inserted timestamp DEFAULT CURRENT_TIMESTAMP,
                date_updated timestamp,
                CONSTRAINT esgi_homepage_pkey PRIMARY KEY (id),
                CONSTRAINT fk_esgi_homepage_page_id FOREIGN KEY (page_id) REFERENCES esgi_page (id) ON DELETE CASCADE
            ) WITH (oids = false);
        ';

        $db->exec($SQL);
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = 'DROP TABLE esgi_page;';
        $db->exec($SQL);
    }
}
