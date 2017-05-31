-- Lisää INSERT INTO lauseet tähän tiedostoon


INSERT INTO Usr (name, password, admin) VALUES ('testi', 'testi', true);
INSERT INTO Usr (name, password, admin) VALUES ('testi1', 'testi1', false);

INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('testikysymys', 'onko meillä kivaa', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('toinenTestikysymys', 'kikkeliskokkelis???', 'kyllä', 'kyllä;ei');


INSERT INTO Organization (name) VALUES ('Testisad');
INSERT INTO Organization (name) VALUES ('asnkdkasndk');
