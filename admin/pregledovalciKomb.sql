CREATE OR REPLACE VIEW pregledovalciKomb AS
SELECT bolnisnica, ime, priimek FROM uporabnikiTbl WHERE pristop >=1
UNION
SELECT bolnisnica, ime, priimek FROM pregledovalciTbl WHERE pregledovalciStatus >=1;