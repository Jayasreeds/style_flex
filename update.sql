TRUNCATE TABLE invoice_sub;
TRUNCATE TABLE invoice_payment;
TRUNCATE TABLE invoice_base;
TRUNCATE TABLE price_details;
TRUNCATE TABLE quality_details;
TRUNCATE TABLE size_details;
TRUNCATE TABLE size_type;
TRUNCATE TABLE quotation_sub;
TRUNCATE TABLE quotation_base;
TRUNCATE TABLE temp_quotation;
TRUNCATE TABLE temp_billing;
TRUNCATE TABLE branch;
TRUNCATE TABLE customer_details;


ALTER TABLE `temp_billing` ADD `tempbillno` VARCHAR(255) NULL AFTER `id`;