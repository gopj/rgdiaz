<?php

/*
 * Copyright 2004-2014, AfterLogic Corp.
 * Licensed under AGPLv3 license or AfterLogic license
 * if commercial version of the product was purchased.
 * See the LICENSE file for a full license statement.
 */

	define('CM_MODE_DB', 'db');
	define('CM_MODE_SECURITY', 'security');
	define('CM_MODE_RESOURCE_USAGE', 'resourceusage');
	define('CM_MODE_HELPDESK', 'helpdesk');
	define('CM_MODE_SIP', 'sip');
	define('CM_MODE_TWILIO', 'twilio');
	define('CM_MODE_SOCIAL', 'social');
	define('CM_MODE_TENANT', 'tenant');
	define('CM_MODE_BRANDING', 'branding');
	define('CM_SWITCHER_MODE_NEW_DOMAIN', 'newdomain');
	define('CM_SWITCHER_MODE_EDIT_DOMAIN_GENERAL', 'editgeneral');

	define('CM_SWITCHER_MODE_NEW_USER', 'newuser');
	define('CM_SWITCHER_MODE_EDIT_USER_GENERAL', 'editgeneral');
	define('CM_SWITCHER_MODE_EDIT_USER_SIP', 'editsip');
	define('CM_SWITCHER_MODE_EDIT_USER_TWILIO', 'edittwilio');

	/* langs */

	define('CM_MODE_RESOURCE_USAGE_NAME', CApi::I18N('ADMIN_PANEL/SUBTABNAME_RESOURCE_USAGE'));
	define('CM_MODE_HELPDESK_NAME', CApi::I18N('ADMIN_PANEL/SUBTABNAME_HELPDESK'));
	define('CM_MODE_SIP_NAME', CApi::I18N('ADMIN_PANEL/SUBTABNAME_SIP'));
	define('CM_MODE_TWILIO_NAME', CApi::I18N('ADMIN_PANEL/SUBTABNAME_TWILIO'));
	define('CM_MODE_SOCIAL_NAME', CApi::I18N('ADMIN_PANEL/SUBTABNAME_SOCIAL'));
	define('CM_MODE_TENANT_NAME', CApi::I18N('ADMIN_PANEL/SUBTABNAME_TENANT'));
	define('CM_MODE_BRANDING_NAME', CApi::I18N('ADMIN_PANEL/SUBTABNAME_BRANDING'));
	define('CM_MODE_DB_NAME', CApi::I18N('ADMIN_PANEL/SUBTABNAME_DATABASE'));
	define('CM_MODE_SECURITY_NAME', CApi::I18N('ADMIN_PANEL/SUBTABNAME_SECURITY'));
	define('CM_SWITCHER_MODE_NEW_DOMAIN_NAME', CApi::I18N('ADMIN_PANEL/TOOLBAR_BUTTON_NEW_DOMAIN'));
	define('CM_SWITCHER_MODE_EDIT_DOMAIN_GENERAL_NAME', CApi::I18N('ADMIN_PANEL/EDIT_DOMAIN_GENERAL_NAME'));

	define('CM_SWITCHER_MODE_NEW_USER_NAME', CApi::I18N('ADMIN_PANEL/TOOLBAR_BUTTON_NEW_USER'));
	define('CM_SWITCHER_MODE_EDIT_USER_GENERAL_NAME', CApi::I18N('ADMIN_PANEL/EDIT_USERS_GENERAL_NAME'));
	define('CM_SWITCHER_MODE_EDIT_USER_SIP_NAME', CApi::I18N('ADMIN_PANEL/EDIT_USERS_SIP_NAME'));
	define('CM_SWITCHER_MODE_EDIT_USER_TWILIO_NAME', CApi::I18N('ADMIN_PANEL/EDIT_USERS_TWILIO_NAME'));

	define('CM_LANG_NODOMAINS', CApi::I18N('ADMIN_PANEL/INFO_NODOMAINS'));
	define('CM_LANG_NODOMAINS_RESULTEMPTY', CApi::I18N('ADMIN_PANEL/INFO_DOMAINS_NOT_FOUND'));
	define('CM_LANG_NOUSERSINDOMAIN', CApi::I18N('ADMIN_PANEL/INFO_NOUSERS'));
	define('CM_LANG_USERS_RESULTEMPTY', CApi::I18N('ADMIN_PANEL/INFO_USERS_NOT_FOUND'));
	define('CM_LANG_TOTAL_USERS', CApi::I18N('ADMIN_PANEL/INFO_USERS_TOTAL'));

	define('CM_LANG_ACCOUNT_EXIST', CApi::I18N('ADMIN_PANEL/MSG_USER_EXIST'));
	define('CM_LANG_DOMAIN_EXIST', CApi::I18N('ADMIN_PANEL/MSG_DOMAIN_EXIST'));
	define('CM_LANG_DELETE_SUCCESSFUL', CApi::I18N('ADMIN_PANEL/MSG_DELETE_SUCCESSFUL'));
	define('CM_LANG_DELETE_UNSUCCESSFUL', CApi::I18N('ADMIN_PANEL/MSG_DELETE_UNSUCCESSFUL'));

	define('CM_PASSWORDS_NOT_MATCH', CApi::I18N('ADMIN_PANEL/MSG_PASSWORD_MISMATCH'));