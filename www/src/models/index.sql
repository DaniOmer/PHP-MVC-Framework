DROP TABLE IF EXISTS "esgi_user";
DROP SEQUENCE IF EXISTS esgi_user_id_seq;
CREATE SEQUENCE esgi_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_user" (
                                      "id" integer DEFAULT nextval('esgi_user_id_seq') NOT NULL,
                                      "firstname" character varying(60) NOT NULL,
                                      "lastname" character varying(120) NOT NULL,
                                      "email" character varying(320) NOT NULL,
                                      "pwd" character varying(255) NOT NULL,
                                      "date_inserted" timestamp NOT NULL,
                                      "date_updated" timestamp,
                                      "status" boolean NOT NULL,
                                      CONSTRAINT "esgi_user_pkey" PRIMARY KEY ("id")
) WITH (oids = false);