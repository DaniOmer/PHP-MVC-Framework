<?php

use App\core\Application;

class m0001_initial
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = '
            DROP TABLE IF EXISTS esgi_user;
            DROP SEQUENCE IF EXISTS esgi_user_id_seq;
            CREATE SEQUENCE esgi_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

            CREATE TABLE public.esgi_user (
                id integer DEFAULT nextval(\'esgi_user_id_seq\') NOT NULL,
                firstname character varying(60) NOT NULL,
                lastname character varying(120) NOT NULL,
                email character varying(320) NOT NULL,
                password character varying(255) NOT NULL,
                date_inserted timestamp DEFAULT CURRENT_TIMESTAMP,
                date_updated timestamp,
                code character varying(64) NOT NULL,
                status character varying(30),
                CONSTRAINT esgi_user_pkey PRIMARY KEY (id)
            ) WITH (oids = false);
        ';

        $db->exec($SQL);
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = 'DROP TABLE esgi_user;';
        $db->exec($SQL);
    }
}
