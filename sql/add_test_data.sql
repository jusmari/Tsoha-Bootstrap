-- Lisää INSERT INTO lauseet tähän tiedostoon


INSERT INTO Usr (name, password, admin) VALUES ('admin', 'admin', true);
INSERT INTO Usr (name, password, admin) VALUES ('testi', 'testi', false);

INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('testikysymys', 'onko meillä kivaa', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('toinenTestikysymys', 'kikkeliskokkelis???', 'kyllä', 'kyllä;ei');


INSERT INTO Organization (name) VALUES ('Matlu');
INSERT INTO Organization (name) VALUES ('Tekis');

INSERT INTO Membership (organization_id, usr_id) VALUES (1, 1);
INSERT INTO Membership (organization_id, usr_id) VALUES (1, 2);
INSERT INTO Membership (organization_id, usr_id) VALUES (2, 2);

INSERT INTO Answer (usr_id, question_id, correct) VALUES (1, 1, true);
INSERT INTO Answer (usr_id, question_id, correct) VALUES (1, 2, false);
INSERT INTO Answer (usr_id, question_id, correct) VALUES (2, 2, true);
