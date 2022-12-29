
CREATE DATABASE IF NOT EXISTS prueba_suplos;

use prueba_suplos;

-- ALTER TABLE process_events
--   DROP FOREIGN KEY fk_users_process;
-- ALTER TABLE process_events
--   DROP FOREIGN KEY fk_activities_process;
-- ALTER TABLE process_events
--   DROP FOREIGN KEY fk_activities_statuses;
-- ALTER TABLE process_event_attachments
--   DROP FOREIGN KEY fk_attachment_process;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS statuses;
DROP TABLE IF EXISTS activities;
DROP TABLE IF EXISTS process_events;
DROP TABLE IF EXISTS process_event_attachments;

CREATE TABLE IF NOT EXISTS users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO users (name, last_name) VALUE ('John', 'Doe');

CREATE TABLE IF NOT EXISTS statuses (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO statuses (name) VALUE ('ACTIVO'), ('PUBLICADO'), ('EVALUACIÓN'), ('INACTIVO');

CREATE TABLE IF NOT EXISTS activities (
  code INT(11) PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS process_events (
  id INT(11) AUTO_INCREMENT,
  object VARCHAR(255) NOT NULL,
  description VARCHAR(500) NOT NULL,
  activity_code INT,
  currency VARCHAR(50) NOT NULL,
  budget DECIMAL(12, 2),
  user_id INT DEFAULT 1,
  status_id INT DEFAULT 1,
  start_date DATE,
  start_hour TIME,
  end_date DATE,
  end_hour TIME,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_users_process FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT fk_activities_process FOREIGN KEY (activity_code) REFERENCES activities(code),
  CONSTRAINT fk_activities_statuses FOREIGN KEY (status_id) REFERENCES statuses(id)
);

CREATE TABLE IF NOT EXISTS process_event_attachments (
  id INT(11) UNSIGNED AUTO_INCREMENT,
  process_event_id INT,
  name VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  type_file VARCHAR(255) NOT NULL,
  description VARCHAR(500) NOT NULL,
  file LONGBLOB,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_attachment_process FOREIGN KEY (process_event_id) REFERENCES process_events(id)
);