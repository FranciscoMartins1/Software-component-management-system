-- NOME DA BASE DE DADOS: srsWeb

CREATE TABLE srsUserRole (
    RoleID INT AUTO_INCREMENT,
    RoleName varchar(15) NOT NULL,
    PRIMARY KEY(RoleID)
);


CREATE TABLE srsUser (
    UserID INT AUTO_INCREMENT ,
    LoginUsername varchar(20) NOT NULL UNIQUE,
    LoginPassword varchar(30) NOT NULL,
    UserName varchar(50) NOT NULL,
    UserAddress varchar(70) NOT NULL,
    UserNIF varchar(9) NOT NULL UNIQUE,
    UserEmail varchar(40) NOT NULL,
    UserRoleID INT NOT NULL,
    PRIMARY KEY(UserID),
    FOREIGN KEY (UserRoleID) REFERENCES srsUserRole(RoleID)
);


CREATE TABLE srsComp (
    CompID INT AUTO_INCREMENT ,
    CompName varchar(20) NOT NULL,
    CompDescr varchar(30),
    CompDate date NOT NULL,
    CompCode varchar(20) NOT NULL,
    CompUserID INT NOT NULL,
    compDepend int,
    PRIMARY KEY(CompID),
    FOREIGN KEY (CompUserID) REFERENCES srsUser(UserID),
    FOREIGN KEY (compDepend) REFERENCES srsComp(CompID)
);


CREATE TABLE srsCompVersion (
    VersionID INT AUTO_INCREMENT ,
    VersionName varchar(40) NOT NULL,
    VersionDate date NOT NULL,
    VersionCode varchar(50) NOT NULL,
    VersionCompID INT NOT NULL,
    PRIMARY KEY(VersionID),
    FOREIGN KEY (VersionCompID) REFERENCES srsComp(CompID)
);


CREATE TABLE srsPerm (
    PermID int AUTO_INCREMENT,
    PermDescr varchar(40) NOT NULL,
    PRIMARY KEY(PermID)
);


CREATE TABLE srsDevPerm (
    DevPermID INT AUTO_INCREMENT,
    DevID INT NOT NULL ,
    PermissionID INT NOT NULL,
    PRIMARY KEY(DevPermID),
    FOREIGN KEY (DevID) REFERENCES srsUser(UserID),
    FOREIGN KEY (PermissionID) REFERENCES srsPerm(PermID)
);

CREATE TABLE 'srsBackup' (
    'backupFileId' int NOT NULL AUTO_INCREMENT,
    'backupData' longblob,
    'backupName' varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
    'backupFileType' varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
    'backupFileSize' varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
    'backupFileTmpName' varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
    'backupFileError' varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
    'backFileURL' varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
    'backupUpload_on' datetime NOT NULL,
    'status' enum('1','0') CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '1',
    PRIMARY KEY ('backupFileId')
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--- INSERTS

INSERT INTO srsUserRole (RoleName) VALUES
('admin'),
('developer');


INSERT INTO srsUser (LoginUsername, LoginPassword, UserName, UserAddress, UserNIF, UserEmail, UserRoleID) VALUES
('adm', '123', 'adminn', 'rua bbbb', '123456789', 'admin@admin.admin', 1);

INSERT INTO srsUser (LoginUsername, LoginPassword, UserName, UserAddress, UserNIF, UserEmail, UserRoleID) VALUES
('dev', '321', 'devvv', 'rua aaaa', '987654321', 'devr@dev.dev', 2);