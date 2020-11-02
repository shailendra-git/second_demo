- USER TYPES
 - owner
 - tenant
 - worker
 =====================
 AUTHENTICATION
 - owner signin
 - owner forgot password
 - owner signup
 =====================

- owner 
 - owner created dummy
 -----------------------------
OWNER CAN - 
----------
 - PROPERTY SECTION
 - TEAM SECTION

 PROPERTIES ARE ASSOCIATED TO THE OWNER
 --------------------------------------
 = ADD PROPERTY
 = LISTING THE PROPERTY : http://onelane.local.wiseit.com/owner/properties
 = EDIT PROPERTY : http://onelane.local.wiseit.com/owner/property_basicinfo/2/basic-info
 = ADD UNITS TO THE PROPERTY
 = EDIT UNITS TO THE PROPERTY
 = PROPER CHECKS APPLIED WHILE EDIT THE UNIT

 TEAMS ARE ASSOCIATED TO THE OWNER
 --------------------------------------
 = ADD TEAM 
 = EDIT TEAM http://onelane.local.wiseit.com/team/getTeams
 = ASSOCIATE TEAM TO SERVICES
 = LISTING TEAMS
-------------------------------------------------
- apply current class to the sidemenu
- title text
- proper messages after every event like email send, wrong credentials etc


- CREATE REQUEST
	-  create request for the particular property and select unit for which owner need to maintenance
	-  assign the request to one or more tasks to the same or different person
	-  listout the assign tasks

	onelane_property_unit_doc
	-------------------------
	- table is pending


	maintenance_request
	-------------------
	- id
	- ownerid
	- propertyid
	- unitid
	- assignedservicetype
	- request (only main heading of the request like : request for fan repair)
	- description (description in detail)
	- active_status (open/close)
	- 

	onelane_maintenance_task_allocation
	- id
	- maintenance_request_id
	- service_pro_id(to whom task will alot)
	- billing_contact(user)

	onelane_maintenance_order_progressdoc
	id
	property_id
	unit_id
	order_id
	file_name
	doc_upload_time
	doc_update_time

=========================== TO ASK ================================
- REF (while work order)?
- Scheduled Date: TBD ?

add this field to request table
is_tenantsee


allocation table add these fields
-----------------
startdate
enddate
notes
order_status
ref_no.

------------------------------------
create three folder for uploading
- 3 types of doc upload
1. property
2. unit
3. maintenace request
---------------------------------
