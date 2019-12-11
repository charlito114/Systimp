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
    

DROP EVENT OVERDUE; 
CREATE EVENT OVERDUE
 ON SCHEDULE EVERY 1 minute
    STARTS '2010-01-02 12:02:00'
    DO
	UPDATE p_purchasingmanagement
    SET status = 'Overdue'
    WHERE Date < date_sub(now(),interval 7 day) AND status= 'Pending';
    
DROP EVENT IF EXISTS dailyinventoryreport;

CREATE EVENT dailyinventoryreport
    ON SCHEDULE EVERY 1 DAY 
    STARTS '2019-12-04 12:00:00'  
DO
INSERT INTO	inventoryreport (category,brand,prodcode,proddesc,size,repoint,prodquan)
SELECT 		category, brand, prodcode, proddesc, size, repoint, prodquan
FROM	products
WHERE	status ='Available';

DROP EVENT IF EXISTS monthlysalesreport;

CREATE EVENT monthlysalesreport
    ON SCHEDULE EVERY 1 minute 
    STARTS '2019-12-04 12:00:00'  
DO
INSERT INTO	salesreport (date,grosssales,discount,vat,netsales)
SELECT 		date, SUM(salesbeforeVat), SUM(discount), SUM(vat), SUM(salesafterVat)
FROM	salesmanagement
WHERE	date BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01 00:00:00')
AND DATE_FORMAT(LAST_DAY(NOW() - INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59')
GROUP BY date