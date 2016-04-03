CREATE DATABASE IF NOT EXISTS face_book_auth
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

DROP TABLE IF EXISTS face_book_auth.account;

CREATE TABLE IF NOT EXISTS face_book_auth.account (
  acc_id BIGINT(20) NOT NULL,
  acc_first_name VARCHAR(20),
  acc_last_name VARCHAR(20),
  acc_is_active BOOLEAN DEFAULT false,
  acc_access_token VARCHAR(255),
  PRIMARY KEY (acc_id, acc_first_name)
);

DROP TABLE IF EXISTS face_book_auth.app_credentials;

CREATE TABLE IF NOT EXISTS face_book_auth.app_credentials (
  acr_id BIGINT(20) NOT NULL,
  acr_type VARCHAR(20),
  acr_value VARCHAR(255),
  PRIMARY KEY (acr_id, acr_type)
);