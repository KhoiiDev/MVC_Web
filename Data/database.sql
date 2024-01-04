CREATE TABLE Account
(
  username varchar(255) NOT NULL,
  firstname varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  decentralization varchar(255) NOT NULL,
  activate_token varchar(255) NOT NULL,
  PRIMARY KEY (username),
  UNIQUE (email)
);

CREATE TABLE Class
(
  idClass INT NOT NULL AUTO_INCREMENT,
  className varchar(255) NOT NULL,
  teacherName varchar(255) NOT NULL,
  classroom varchar(255) NOT NULL,
  groupName varchar(255) NOT NULL,
  codeClass varchar(255) NOT NULL,
  PRIMARY KEY (idClass)
);

CREATE TABLE ClassAccount
(
  username varchar(255) NOT NULL,
  idClass INT NOT NULL,
  PRIMARY KEY (username, idClass),
  FOREIGN KEY (username) REFERENCES Account(username),
  FOREIGN KEY (idClass) REFERENCES Class(idClass)
);

CREATE TABLE Post
(
  postID INT NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  content varchar(255) NOT NULL,
  fileupload varchar(255) NOT NULL,
  postingTime datetime NOT NULL,
  username varchar(255) NOT NULL,
  idClass INT NOT NULL,
  PRIMARY KEY (postID),
  FOREIGN KEY (username) REFERENCES Account(username),
  FOREIGN KEY (idClass) REFERENCES Class(idClass)
);

CREATE TABLE Assignment
(
  assignmentID INT NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  content varchar(255) NOT NULL,
  fileupload varchar(255) NOT NULL,
  postingTime datetime NOT NULL,
  deadlines varchar(255) NOT NULL,
  username varchar(255) NOT NULL,
  idClass INT NOT NULL,
  PRIMARY KEY (assignmentID),
  FOREIGN KEY (username) REFERENCES Account(username),
  FOREIGN KEY (idClass) REFERENCES Class(idClass)

);

CREATE TABLE Submit
(
  submitID INT NOT NULL AUTO_INCREMENT,
  fileupload varchar(255) NOT NULL,
  timeSubmit datetime NOT NULL,
  usSubmit varchar(255) NOT NULL,
  assignmentID INT NOT NULL,
  PRIMARY KEY (submitID),
  FOREIGN KEY (assignmentID) REFERENCES Assignment(assignmentID),
  UNIQUE (usSubmit)
);
