-- Lisää CREATE TABLE lauseet tähän tiedostoon


CREATE TABLE Usr(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  admin boolean NOT NULL
);

CREATE TABLE Question(
  id SERIAL PRIMARY KEY,
  body varchar(140) NOT NULL,
  correctAnswer varchar(140) NOT NULL,
  possibleAnswers varchar(200) NOT NULL
);

CREATE TABLE Organization(
  id SERIAL PRIMARY KEY,
  name varchar(140) NOT NULL
);

CREATE TABLE Membership(
  organization_id INTEGER REFERENCES Organization(id),
  usr_id INTEGER REFERENCES Usr(id)
);

CREATE TABLE Answers(
  usr_id INTEGER REFERENCES Usr(id),
  question_id INTEGER REFERENCES Question(id),
  correct boolean NOT NULL
);
