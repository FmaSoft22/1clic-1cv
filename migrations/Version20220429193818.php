<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429193818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE candidateexperiences (ID BIGINT NOT NULL, CandidateID BIGINT NOT NULL, StartDate DATETIME DEFAULT NULL, EndDate DATETIME DEFAULT NULL, Title VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Description VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CompanyID BIGINT DEFAULT NULL, CreationDate DATETIME DEFAULT NULL, ModificationDate DATETIME DEFAULT NULL, Status VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE candidatelanguage (ID BIGINT NOT NULL, CandidateID BIGINT NOT NULL, LanguageID BIGINT NOT NULL, Level VARCHAR(1) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, YearOfExperienceID VARCHAR(1) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE candidates (CandidateID BIGINT NOT NULL, Guid CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, Reference VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Title VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, FirstName VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, LastName VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, MiddleName VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, DateOfBirth DATETIME DEFAULT NULL, Nationality VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CountryID VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Town VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, PostalCode VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, MarialStatus VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Address1 VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Address2 VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Phone1 VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Phone2 VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, drivingLicence VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Active TINYINT(1) DEFAULT NULL, Publish TINYINT(1) DEFAULT NULL, Weight VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Size VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CreationDate VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, ModificationDate VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Availability TINYINT(1) DEFAULT NULL, AvailabilityDate DATETIME DEFAULT NULL, Score SMALLINT DEFAULT NULL, LastConnectionDate DATETIME DEFAULT NULL, CandidateImage VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE career (careerID BIGINT NOT NULL, positionSought VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, objective VARCHAR(1000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, positionID VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, noticePeriod VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, employmentType VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, employmentStatus VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, salary VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, salaryPeriod VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, salaryCurrency VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, executive TINYINT(1) DEFAULT NULL, note VARCHAR(8000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CandidateID BIGINT NOT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE categorie (ID BIGINT NOT NULL, Name VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Description VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Active TINYINT(1) DEFAULT NULL, CatImage VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, DisplayOrder SMALLINT DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE company (ID BIGINT NOT NULL, Guid CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, Name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, holding VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, RegisterNumber VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, ActivityCode VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, ActivityDescription VARCHAR(8000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CountryID VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Town VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, PostalCode VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CompanyLogo VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, WebSite VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, eMail VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Address1 VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Address2 VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Phone VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Fax VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Note VARCHAR(8000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CreationDate VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, ModificationDate VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CandidateID BIGINT DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE cvtemplate (ID BIGINT NOT NULL, TemplateGuid CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, TemplateName VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Description VARCHAR(1000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, HtmlContent VARCHAR(8000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CreationDate DATETIME DEFAULT NULL, ModificationDate DATETIME DEFAULT NULL, Active TINYINT(1) DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE degree (ID BIGINT NOT NULL, Degree VARCHAR(2000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, DegreePercent NUMERIC(18, 0) DEFAULT NULL, Active TINYINT(1) DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE document (ID BIGINT NOT NULL, CandidateID BIGINT NOT NULL, Reference VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, FileName VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Title VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Description VARCHAR(500) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CreationDate DATETIME DEFAULT NULL, ModificationDate DATETIME DEFAULT NULL, DocumentLinkID BIGINT DEFAULT NULL, URI VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Entity VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, EntityID BIGINT DEFAULT NULL, Version VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, DisplayOrder TINYINT(1) DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE education (ID BIGINT NOT NULL, CandidateID BIGINT NOT NULL, Title VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Description VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Institution VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, DegreeID VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CompanyID BIGINT DEFAULT NULL, CountryID BIGINT DEFAULT NULL, Town BIGINT DEFAULT NULL, StartDate DATETIME DEFAULT NULL, EndDate DATETIME DEFAULT NULL, Status VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Major VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, LastUsed VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CreationDate DATETIME DEFAULT NULL, ModificationDate DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE employmenttypelist (employmentTypeID BIGINT DEFAULT NULL, employmentType BIGINT DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE language (ID BIGINT NOT NULL, Name VARCHAR(1) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE options (ID BIGINT NOT NULL, Options VARCHAR(2000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Active TINYINT(1) DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE positions (ID BIGINT NOT NULL, position VARCHAR(1) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE projets (ID BIGINT NOT NULL, ProjetTitle VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, ProjetDescription VARCHAR(8000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, StartDate DATETIME DEFAULT NULL, EndDate DATETIME DEFAULT NULL, Status VARCHAR(1) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CompanyID BIGINT DEFAULT NULL, URL VARCHAR(1000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CreationDate DATETIME DEFAULT NULL, ModificationDate DATETIME DEFAULT NULL, FrontImageURI VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Publish TINYINT(1) DEFAULT NULL, Active TINYINT(1) DEFAULT NULL, CategoryID BIGINT DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE services (ID BIGINT NOT NULL, Reference VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Title VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Description VARCHAR(8000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CreationDate DATETIME DEFAULT NULL, ModificationDate DATETIME DEFAULT NULL, Price NUMERIC(18, 0) DEFAULT NULL, Currency VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, FrontImage VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, InPromotion TINYINT(1) DEFAULT NULL, PromoPercent NUMERIC(18, 0) DEFAULT NULL, CategoryID BIGINT DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE skill (ID BIGINT NOT NULL, CandidateID BIGINT NOT NULL, Title VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Description VARCHAR(8000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, Level VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, YearOfExperienceID VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, LastUsed VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CreationDate DATETIME DEFAULT NULL, ModificationDate DATETIME DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE yearofexperience (ID BIGINT NOT NULL, Name VARCHAR(1) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE zonegeo_country_citylist (ID BIGINT NOT NULL, ZoneGeo VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CountryID VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, LabelCountryFR VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, LabelCountryEN VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CityListFR VARCHAR(1000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CityListEN VARCHAR(1000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CountryPhoneCode VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CountryFlag VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE candidateexperiences');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE candidatelanguage');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE candidates');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE career');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE categorie');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE company');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE cvtemplate');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE degree');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE document');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE education');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE employmenttypelist');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE language');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE options');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE positions');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE projets');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE services');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE skill');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE yearofexperience');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE zonegeo_country_citylist');
    }
}
