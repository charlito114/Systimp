SHOW PROCESSLIST;
SET GLOBAL EVENT_SCHEDULER = OFF;
SET GLOBAL EVENT_SCHEDULER = ON;
SHOW EVENTS;

DROP EVENT inventoryreport;
CREATE EVENT inventoryreport
 ON SCHEDULE EVERY 1 day
    STARTS '2010-01-02 17:00:00'
    DO
	INSERT INTO inventoryreport (category,brand,prodcode, proddesc, size,repoint,prodquan)
    (SELECT category, brand, prodcode, proddesc, size, repoint, prodquan FROM products);
    

