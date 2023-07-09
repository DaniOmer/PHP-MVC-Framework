<?php

/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/migrations/m0002_page.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

use App\core\Application;
 
class m0002_page
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = '
            DROP TABLE IF EXISTS esgi_page;
            DROP SEQUENCE IF EXISTS esgi_page_id_seq;
            CREATE SEQUENCE esgi_page_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

            CREATE TABLE public.esgi_page (
                id integer DEFAULT nextval(\'esgi_page_id_seq\') NOT NULL,
                user_id integer NOT NULL,
                title character varying(60) NOT NULL,
                page_uri character varying(60) NOT NULL,
                seo_title character varying(60) NOT NULL,
                seo_keywords character varying(300) NOT NULL,
                seo_description character varying(700) NOT NULL,
                date_inserted timestamp DEFAULT CURRENT_TIMESTAMP,
                date_updated timestamp,
                template character varying(60) NOT NULL,
                on_menu character varying(30) NOT NULL,
                CONSTRAINT esgi_page_pkey PRIMARY KEY (id),
                CONSTRAINT fk_esgi_page_user_id FOREIGN KEY (user_id) REFERENCES esgi_user (id) ON DELETE CASCADE
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
