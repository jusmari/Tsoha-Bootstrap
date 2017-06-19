-- Lisää INSERT INTO lauseet tähän tiedostoon


INSERT INTO Usr (name, password, admin, email) VALUES ('testi1', 'testi1', false, 'testi1@testi.com');
INSERT INTO Usr (name, password, admin, email) VALUES ('testi2', 'testi1', false, 'testi2@testi.com');
INSERT INTO Usr (name, password, admin, email) VALUES ('testi3', 'testi1', false, 'testi3@testi.com');


INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('testikysymys', 'onko meillä kivaa', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');
INSERT INTO Question (name, body, correctAnswer, possibleAnswers) VALUES ('Peruskysymys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis metus et augue fermentum accumsan non eget mi. Integer hendrerit ligula justo, at congue eros consectetur quis.', 'kyllä', 'kyllä;ei');



INSERT INTO Organization (name) VALUES ('Matlu');
INSERT INTO Organization (name) VALUES ('Tekis');
INSERT INTO Organization (name) VALUES ('MaO');
INSERT INTO Organization (name) VALUES ('Geysir');
INSERT INTO Organization (name) VALUES ('Matrix');
INSERT INTO Organization (name) VALUES ('Resonanssi');
INSERT INTO Organization (name) VALUES ('HYK');
INSERT INTO Organization (name) VALUES ('Synop');
INSERT INTO Organization (name) VALUES ('Vasara');
INSERT INTO Organization (name) VALUES ('Moodi');
INSERT INTO Organization (name) VALUES ('Meridiaani');
INSERT INTO Organization (name) VALUES ('Spektrum');
INSERT INTO Organization (name) VALUES ('Limes');

INSERT INTO Membership (organization_id, usr_id) VALUES (1, 1);
INSERT INTO Membership (organization_id, usr_id) VALUES (1, 2);
INSERT INTO Membership (organization_id, usr_id) VALUES (2, 2);

INSERT INTO Answer (usr_id, question_id, correct) VALUES (1, 1, true);
INSERT INTO Answer (usr_id, question_id, correct) VALUES (1, 2, false);
INSERT INTO Answer (usr_id, question_id, correct) VALUES (2, 2, true);
