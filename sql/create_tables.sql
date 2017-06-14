-- Lisää CREATE TABLE lauseet tähän tiedostoon


CREATE TABLE Usr(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  admin boolean DEFAULT false
);

CREATE TABLE Question(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  body varchar(140) NOT NULL,
  correctAnswer varchar(140) NOT NULL,
  possibleAnswers varchar(200) NOT NULL
);

CREATE TABLE Organization(
  id SERIAL PRIMARY KEY,
  name varchar(140) NOT NULL
);

CREATE TABLE Membership(
  organization_id INTEGER REFERENCES Organization(id) NOT NULL,
  usr_id INTEGER REFERENCES Usr(id) NOT NULL
);

CREATE TABLE Answer(
  usr_id INTEGER REFERENCES Usr(id) NOT NULL,
  question_id INTEGER REFERENCES Question(id) NOT NULL,
  correct boolean NOT NULL
);
