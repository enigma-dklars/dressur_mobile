<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/sendMailToDressur' => [[['_route' => 'api_sendMailToDressur', '_controller' => 'App\\Controller\\API\\AdminController::sendMailToDressur'], null, null, null, false, false, null]],
        '/api/admin/promos-en-attente' => [[['_route' => 'api_admin_promos_en_attente', '_controller' => 'App\\Controller\\API\\AdminController::promosEnAttente'], null, ['GET' => 0], null, false, false, null]],
        '/api/utiliserCodePartenaire' => [[['_route' => 'api_utiliserCodePartenaire', '_controller' => 'App\\Controller\\API\\AffiliationController::utiliserCodePartenaire'], null, ['POST' => 0], null, false, false, null]],
        '/api/listeFormuleBoost' => [[['_route' => 'api_listeFormuleBoost', '_controller' => 'App\\Controller\\API\\BoostController::listeFormuleBoost'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/freeBoostInfo' => [[['_route' => 'api_freeBoostInfo', '_controller' => 'App\\Controller\\API\\BoostController::freeBoostInfo'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/newBoost' => [[['_route' => 'api_newBoost', '_controller' => 'App\\Controller\\API\\BoostController::newBoost'], null, ['POST' => 0], null, false, false, null]],
        '/api/newBoostPayant' => [[['_route' => 'api_newBoostPayant', '_controller' => 'App\\Controller\\API\\BoostController::newBoostPayant'], null, ['POST' => 0], null, false, false, null]],
        '/api/chat/history' => [[['_route' => 'api_chat_history', '_controller' => 'App\\Controller\\API\\ChatController::history'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/chat' => [[['_route' => 'api_chat_chat', '_controller' => 'App\\Controller\\API\\ChatController::chat'], null, ['POST' => 0], null, false, false, null]],
        '/api/allUserAddDressur' => [[['_route' => 'api_addUserContact', '_controller' => 'App\\Controller\\API\\ContactController::addUserContact'], null, null, null, false, false, null]],
        '/api/dressurUserBot' => [[['_route' => 'api_dressurUserBot', '_controller' => 'App\\Controller\\API\\DressurBotController::dressurUserBot'], null, null, null, false, false, null]],
        '/api/listeFormuleDressurBot' => [[['_route' => 'api_listeFormuleDressurBot', '_controller' => 'App\\Controller\\API\\DressurBotController::listeFormuleDressurBot'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/paiementDressurUserBot' => [[['_route' => 'api_paiementDressurUserBot', '_controller' => 'App\\Controller\\API\\DressurBotController::paiementDressurUserBot'], null, ['POST' => 0], null, false, false, null]],
        '/api/espacePartenaire' => [[['_route' => 'api_espace_partenaire', '_controller' => 'App\\Controller\\API\\EspacePartenaireController::espacePartenaire'], null, ['POST' => 0], null, false, false, null]],
        '/api/devenirPartenaire' => [[['_route' => 'api_devenir_partenaire', '_controller' => 'App\\Controller\\API\\EspacePartenaireController::devenirPartenaire'], null, ['POST' => 0], null, false, false, null]],
        '/api/accompagnesPartenaire' => [[['_route' => 'api_accompagnes_partenaire', '_controller' => 'App\\Controller\\API\\EspacePartenaireController::accompagnesPartenaire'], null, ['GET' => 0], null, false, false, null]],
        '/api/listeMethodePaiement' => [[['_route' => 'api_listeMethodePaiement', '_controller' => 'App\\Controller\\API\\MethodePaiementController::listeMethodePaiement'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/getNotifications' => [[['_route' => 'api_getNotifications', '_controller' => 'App\\Controller\\API\\NotificationController::getNotifications'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/listeFormulePromoAffaire' => [[['_route' => 'api_listeFormulePromoAffaire', '_controller' => 'App\\Controller\\API\\PromotionController::listeFormulePromoAffaire'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/newDmdEmploi' => [[['_route' => 'api_newDmdEmploi', '_controller' => 'App\\Controller\\API\\PromotionController::newDmdEmploi'], null, ['POST' => 0], null, false, false, null]],
        '/api/newOffreEmploi' => [[['_route' => 'api_newOffreEmploi', '_controller' => 'App\\Controller\\API\\PromotionController::newOffreEmploi'], null, ['POST' => 0], null, false, false, null]],
        '/api/addProduitService' => [[['_route' => 'api_addProduitService', '_controller' => 'App\\Controller\\API\\PromotionController::addProduitService'], null, ['POST' => 0], null, false, false, null]],
        '/api/addSiteApplication' => [[['_route' => 'api_addSiteApplication', '_controller' => 'App\\Controller\\API\\PromotionController::addSiteApplication'], null, ['POST' => 0], null, false, false, null]],
        '/api/editProduitService' => [[['_route' => 'api_editProduitService', '_controller' => 'App\\Controller\\API\\PromotionController::editProduitService'], null, ['POST' => 0], null, false, false, null]],
        '/api/newPromo' => [[['_route' => 'api_newPromo', '_controller' => 'App\\Controller\\API\\PromotionController::newPromo'], null, ['POST' => 0], null, false, false, null]],
        '/api/newPromoPayant' => [[['_route' => 'api_newPromoPayant', '_controller' => 'App\\Controller\\API\\PromotionController::newPromoPayant'], null, ['POST' => 0], null, false, false, null]],
        '/api/getPromotionsDressurStatus' => [[['_route' => 'api_getPromotionsDressurStatus', '_controller' => 'App\\Controller\\API\\PromotionController::getPromotionsDressurStatus'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/listeFormulePromoReseau' => [[['_route' => 'api_listeFormulePromoReseau', '_controller' => 'App\\Controller\\API\\PromotionReseauController::listeFormulePromoReseau'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/newPromoReseau' => [[['_route' => 'api_newPromoReseau', '_controller' => 'App\\Controller\\API\\PromotionReseauController::newPromoReseau'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/purge_ds' => [[['_route' => 'api_purge_ds', '_controller' => 'App\\Controller\\API\\PurgeController::purge_ds'], null, null, null, false, false, null]],
        '/api/addSignalement' => [[['_route' => 'api_addSignalement', '_controller' => 'App\\Controller\\API\\SignalementController::addSignalement'], null, null, null, false, false, null]],
        '/api/getActiveStories' => [[['_route' => 'api_getActiveStories', '_controller' => 'App\\Controller\\API\\StoryController::getActiveStories'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/getTutos' => [[['_route' => 'api_getTutos', '_controller' => 'App\\Controller\\API\\TutoController::getTutos'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/getVersionApp' => [[['_route' => 'api_getVersionApp', '_controller' => 'App\\Controller\\API\\UserController::getVersionApp'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api/connect' => [[['_route' => 'api_connect', '_controller' => 'App\\Controller\\API\\UserController::connect'], null, ['POST' => 0], null, false, false, null]],
        '/api/updateUserInfo' => [[['_route' => 'api_updateUserInfo', '_controller' => 'App\\Controller\\API\\UserController::updateUserInfo'], null, ['POST' => 0], null, false, false, null]],
        '/api/updateUserPassword' => [[['_route' => 'api_updateUserPassword', '_controller' => 'App\\Controller\\API\\UserController::updateUserPassword'], null, ['POST' => 0], null, false, false, null]],
        '/api/getUserInfo' => [[['_route' => 'api_getUserInfo', '_controller' => 'App\\Controller\\API\\UserController::getUserInfo'], null, ['POST' => 0], null, false, false, null]],
        '/api/sendMailVerification' => [[['_route' => 'api_sendMailVerification', '_controller' => 'App\\Controller\\API\\UserController::sendMailVerification'], null, ['POST' => 0], null, false, false, null]],
        '/api/mailVerification' => [[['_route' => 'api_mailVerification', '_controller' => 'App\\Controller\\API\\UserController::mailVerification'], null, ['POST' => 0], null, false, false, null]],
        '/api/sendMailPassForgotWithConnecte' => [[['_route' => 'api_sendMailPassForgotWithConnecte', '_controller' => 'App\\Controller\\API\\UserController::sendMailPassForgotWithConnecte'], null, ['POST' => 0], null, false, false, null]],
        '/api/sendMailPassForgot' => [[['_route' => 'api_sendMailPassForgot', '_controller' => 'App\\Controller\\API\\UserController::sendMailPassForgot'], null, ['POST' => 0], null, false, false, null]],
        '/api/inscriptionDS' => [[['_route' => 'api_inscriptionDS', '_controller' => 'App\\Controller\\API\\UserController::inscriptionDS'], null, ['POST' => 0], null, false, false, null]],
        '/api/deleteCompteDS' => [[['_route' => 'api_deleteCompteDS', '_controller' => 'App\\Controller\\API\\UserController::deleteCompteDS'], null, ['POST' => 0], null, false, false, null]],
        '/api/addSuggestion' => [[['_route' => 'api_addSuggestion', '_controller' => 'App\\Controller\\API\\UserController::addSuggestion'], null, null, null, false, false, null]],
        '/api/getConditionsProgrammeRecompense' => [[['_route' => 'api_getConditionsProgrammeRecompense', '_controller' => 'App\\Controller\\API\\UserController::getConditionsProgrammeRecompense'], null, null, null, false, false, null]],
        '/api/addToRecompenseProgramme' => [[['_route' => 'api_addToRecompenseProgramme', '_controller' => 'App\\Controller\\API\\UserController::addToRecompenseProgramme'], null, null, null, false, false, null]],
        '/api/getPromotionAffaireInProgrammeRecompense' => [[['_route' => 'api_getPromotionAffaireInProgrammeRecompense', '_controller' => 'App\\Controller\\API\\UserController::getPromotionAffaireInProgrammeRecompense'], null, null, null, false, false, null]],
        '/api/partageInProgrammeRecompense' => [[['_route' => 'api_partageInProgrammeRecompense', '_controller' => 'App\\Controller\\API\\UserController::partageInProgrammeRecompense'], null, null, null, false, false, null]],
        '/api/getMyProgrammeRecompenseInformations' => [[['_route' => 'api_getMyProgrammeRecompenseInformations', '_controller' => 'App\\Controller\\API\\UserController::getMyProgrammeRecompenseInformations'], null, null, null, false, false, null]],
        '/api/submitProgrammeRecompenseProofs' => [[['_route' => 'api_submitProgrammeRecompenseProofs', '_controller' => 'App\\Controller\\API\\UserController::submitProgrammeRecompenseProofs'], null, null, null, false, false, null]],
        '/api/updateUserLang' => [[['_route' => 'api_updateUserLang', '_controller' => 'App\\Controller\\API\\UserController::updateUserLang'], null, ['POST' => 0], null, false, false, null]],
        '/api/vendeur/adhesion' => [[['_route' => 'api_vendeur_adhesion', '_controller' => 'App\\Controller\\API\\VendeurController::adhesion'], null, ['POST' => 0], null, false, false, null]],
        '/api/vendeur/recharge' => [[['_route' => 'api_vendeur_recharge', '_controller' => 'App\\Controller\\API\\VendeurController::recharge'], null, ['POST' => 0], null, false, false, null]],
        '/api/zefame' => [[['_route' => 'api_zefame', '_controller' => 'App\\Controller\\API\\ZefameController::zefame'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/crud/communication-mail' => [[['_route' => 'app_communication_mail_portal', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::portal'], null, ['GET' => 0], null, true, false, null]],
        '/crud/communication-mail/file-attente-whatsapp' => [[['_route' => 'app_communication_mail_file_attente_whatsapp', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::fileAttenteWhatsapp'], null, ['GET' => 0], null, false, false, null]],
        '/crud/communication-mail/file-attente-whatsapp/json' => [[['_route' => 'app_communication_mail_file_attente_whatsapp_json', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::fileAttenteWhatsappJson'], null, ['GET' => 0], null, false, false, null]],
        '/crud/communication-mail/file-attente-whatsapp/delete-multiple' => [[['_route' => 'app_communication_mail_file_attente_whatsapp_delete_multiple', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::deleteMultipleFileAttenteWhatsapp'], null, ['POST' => 0], null, false, false, null]],
        '/crud/communication-mail/file-attente-whatsapp/delete-all' => [[['_route' => 'app_communication_mail_file_attente_whatsapp_delete_all', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::deleteAllFileAttenteWhatsapp'], null, ['POST' => 0], null, false, false, null]],
        '/crud/communication-mail/message-personnalise-whatsapp' => [[['_route' => 'app_communication_mail_message_personnalise_whatsapp', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::messagePersonnaliseWhatsapp'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/communication-mail/campagne/prospect' => [[['_route' => 'app_communication_mail_campagne_prospect', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::campagneProspect'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/communication-mail/prospects' => [[['_route' => 'app_communication_mail_prospects', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::prospects'], null, ['GET' => 0], null, false, false, null]],
        '/crud/communication-mail/file-attente' => [[['_route' => 'app_communication_mail_file_attente', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::fileAttente'], null, ['GET' => 0], null, false, false, null]],
        '/crud/communication-mail/file-attente/process-batch' => [[['_route' => 'app_communication_mail_file_attente_process_batch', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::processBatch'], null, ['POST' => 0], null, false, false, null]],
        '/crud/communication-mail/file-attente/delete-multiple' => [[['_route' => 'app_communication_mail_file_attente_delete_multiple', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::deleteMultipleFileAttente'], null, ['POST' => 0], null, false, false, null]],
        '/crud/communication-mail/file-attente/delete-all' => [[['_route' => 'app_communication_mail_file_attente_delete_all', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::deleteAllFileAttente'], null, ['POST' => 0], null, false, false, null]],
        '/crud/communication-mail/log-boite-mail' => [[['_route' => 'app_communication_mail_log', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::logBoiteMail'], null, ['GET' => 0], null, false, false, null]],
        '/crud/boost' => [[['_route' => 'app_crud_boost_index', '_controller' => 'App\\Controller\\Crud\\CrudBoostController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/boost/admin-new' => [[['_route' => 'app_crud_boost_admin_new', '_controller' => 'App\\Controller\\Crud\\CrudBoostController::adminNew'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/boost/new' => [[['_route' => 'app_crud_boost_new', '_controller' => 'App\\Controller\\Crud\\CrudBoostController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/deleted/d/s' => [[['_route' => 'app_crud_deleted_d_s_index', '_controller' => 'App\\Controller\\Crud\\CrudDeletedDSController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/deleted/d/s/new' => [[['_route' => 'app_crud_deleted_d_s_new', '_controller' => 'App\\Controller\\Crud\\CrudDeletedDSController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/env' => [[['_route' => 'app_crud_env_index', '_controller' => 'App\\Controller\\Crud\\CrudEnvController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/env/new' => [[['_route' => 'app_crud_env_new', '_controller' => 'App\\Controller\\Crud\\CrudEnvController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/env-mail-sender' => [[['_route' => 'app_crud_env_mail_sender_index', '_controller' => 'App\\Controller\\Crud\\CrudEnvMailSenderController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/env-mail-sender/reset-last-used-at' => [[['_route' => 'app_crud_env_mail_sender_reset_last_used_at', '_controller' => 'App\\Controller\\Crud\\CrudEnvMailSenderController::resetLastUsedAt'], null, ['GET' => 0], null, false, false, null]],
        '/crud/env-mail-sender/remise-zero' => [[['_route' => 'app_crud_env_mail_sender_remise_zero', '_controller' => 'App\\Controller\\Crud\\CrudEnvMailSenderController::remise_zero'], null, ['GET' => 0], null, false, false, null]],
        '/crud/env-mail-sender/reactivate-all' => [[['_route' => 'app_crud_env_mail_sender_reactivate_all', '_controller' => 'App\\Controller\\Crud\\CrudEnvMailSenderController::reactivate_all'], null, ['GET' => 0], null, false, false, null]],
        '/crud/env-mail-sender/verify-all' => [[['_route' => 'app_crud_env_mail_sender_verify_all', '_controller' => 'App\\Controller\\Crud\\CrudEnvMailSenderController::verify_all'], null, ['GET' => 0], null, false, false, null]],
        '/crud/env-mail-sender/new' => [[['_route' => 'app_crud_env_mail_sender_new', '_controller' => 'App\\Controller\\Crud\\CrudEnvMailSenderController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/env-paiement-api' => [[['_route' => 'app_env_paiement_api_index', '_controller' => 'App\\Controller\\Crud\\CrudEnvPaiementApiController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/env-paiement-api/remise-zero' => [[['_route' => 'app_env_paiement_api_remise_zero', '_controller' => 'App\\Controller\\Crud\\CrudEnvPaiementApiController::remise_zero'], null, ['GET' => 0], null, false, false, null]],
        '/crud/env-paiement-api/new' => [[['_route' => 'app_env_paiement_api_new', '_controller' => 'App\\Controller\\Crud\\CrudEnvPaiementApiController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/formule/boost' => [[['_route' => 'app_crud_formule_boost_index', '_controller' => 'App\\Controller\\Crud\\CrudFormuleBoostController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/formule/boost/new' => [[['_route' => 'app_crud_formule_boost_new', '_controller' => 'App\\Controller\\Crud\\CrudFormuleBoostController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/formule/dressur/bot' => [[['_route' => 'app_crud_formule_dressur_bot_index', '_controller' => 'App\\Controller\\Crud\\CrudFormuleDressurBotController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/formule/dressur/bot/new' => [[['_route' => 'app_crud_formule_dressur_bot_new', '_controller' => 'App\\Controller\\Crud\\CrudFormuleDressurBotController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/formule/promo/affaire' => [[['_route' => 'app_crud_formule_promo_affaire_index', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoAffaireController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/formule/promo/affaire/new' => [[['_route' => 'app_crud_formule_promo_affaire_new', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoAffaireController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/formule/promo/reseau' => [[['_route' => 'app_crud_formule_promo_reseau_index', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoReseauController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/formule/promo/reseau/available' => [[['_route' => 'app_crud_formule_promo_reseau_available', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoReseauController::available'], null, ['GET' => 0], null, false, false, null]],
        '/crud/formule/promo/reseau/new' => [[['_route' => 'app_crud_formule_promo_reseau_new', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoReseauController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/formule/promo/reseau/service_description/next-sans-description' => [[['_route' => 'app_crud_formule_promo_reseau_next_sans_description', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoReseauController::nextSansDescription'], null, ['GET' => 0], null, false, false, null]],
        '/crud/formule/promo/reseau/service_description/info' => [[['_route' => 'app_crud_formule_promo_reseau_service_info', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoReseauController::serviceInfo'], null, ['GET' => 0], null, false, false, null]],
        '/crud/formule/promo/reseau/service_description' => [[['_route' => 'app_crud_formule_promo_reseau_service_description', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoReseauController::service_description'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/methode/paiement' => [[['_route' => 'app_methode_paiement_index', '_controller' => 'App\\Controller\\Crud\\CrudMethodePaiementController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/methode/paiement/new' => [[['_route' => 'app_methode_paiement_new', '_controller' => 'App\\Controller\\Crud\\CrudMethodePaiementController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/mot/refuser' => [[['_route' => 'app_crud_mot_refuser_index', '_controller' => 'App\\Controller\\Crud\\CrudMotRefuserController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/mot/refuser/new' => [[['_route' => 'app_crud_mot_refuser_new', '_controller' => 'App\\Controller\\Crud\\CrudMotRefuserController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/promo/reseau' => [[['_route' => 'app_crud_promo_reseau_index', '_controller' => 'App\\Controller\\Crud\\CrudPromoReseauController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/promo/reseau/promo_reseau_en_attente' => [[['_route' => 'app_crud_promo_reseau_promo_reseau_en_attente', '_controller' => 'App\\Controller\\Crud\\CrudPromoReseauController::promo_reseau_en_attente'], null, ['GET' => 0], null, false, false, null]],
        '/crud/promo/reseau/new' => [[['_route' => 'app_crud_promo_reseau_new', '_controller' => 'App\\Controller\\Crud\\CrudPromoReseauController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/promotion/affaire' => [[['_route' => 'app_crud_promotion_index', '_controller' => 'App\\Controller\\Crud\\CrudPromotionController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/promotion/affaire/promo_en_attente' => [[['_route' => 'app_crud_promotion_promo_en_attente', '_controller' => 'App\\Controller\\Crud\\CrudPromotionController::promo_en_attente'], null, ['GET' => 0], null, false, false, null]],
        '/crud/promotion/affaire/delete_images_no_use' => [[['_route' => 'app_crud_promotion_delete_images_no_use', '_controller' => 'App\\Controller\\Crud\\CrudPromotionController::delete_images_no_use'], null, ['GET' => 0], null, false, false, null]],
        '/crud/promotion/affaire/admin-new' => [[['_route' => 'app_crud_promotion_admin_new', '_controller' => 'App\\Controller\\Crud\\CrudPromotionController::newAdmin'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/promotion/affaire/new' => [[['_route' => 'app_crud_promotion_new', '_controller' => 'App\\Controller\\Crud\\CrudPromotionController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/signalement' => [[['_route' => 'app_crud_signalement_index', '_controller' => 'App\\Controller\\Crud\\CrudSignalementController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/signalement/new' => [[['_route' => 'app_crud_signalement_new', '_controller' => 'App\\Controller\\Crud\\CrudSignalementController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/story' => [[['_route' => 'app_crud_story_index', '_controller' => 'App\\Controller\\Crud\\CrudStoryController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/story/delete-images-no-use' => [[['_route' => 'app_crud_story_delete_images_no_use', '_controller' => 'App\\Controller\\Crud\\CrudStoryController::deleteImagesNoUse'], null, ['GET' => 0], null, false, false, null]],
        '/crud/story/user-search' => [[['_route' => 'app_crud_story_user_search', '_controller' => 'App\\Controller\\Crud\\CrudStoryController::userSearch'], null, ['GET' => 0], null, false, false, null]],
        '/crud/story/new' => [[['_route' => 'app_crud_story_new', '_controller' => 'App\\Controller\\Crud\\CrudStoryController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/suggestion' => [[['_route' => 'app_crud_suggestion_index', '_controller' => 'App\\Controller\\Crud\\CrudSuggestionController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/suggestion/new' => [[['_route' => 'app_crud_suggestion_new', '_controller' => 'App\\Controller\\Crud\\CrudSuggestionController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/transaction' => [[['_route' => 'app_crud_transaction_index', '_controller' => 'App\\Controller\\Crud\\CrudTransactionController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/transaction/new' => [[['_route' => 'app_crud_transaction_new', '_controller' => 'App\\Controller\\Crud\\CrudTransactionController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/user/bot' => [[['_route' => 'app_crud_user_bot_index', '_controller' => 'App\\Controller\\Crud\\CrudUserBotController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/user/bot/new' => [[['_route' => 'app_crud_user_bot_new', '_controller' => 'App\\Controller\\Crud\\CrudUserBotController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/user' => [[['_route' => 'app_crud_user_index', '_controller' => 'App\\Controller\\Crud\\CrudUserController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/user/users-inutiles' => [[['_route' => 'app_crud_user_inutiles', '_controller' => 'App\\Controller\\Crud\\CrudUserController::inutiles'], null, ['GET' => 0], null, false, false, null]],
        '/crud/user/sans-service' => [[['_route' => 'app_crud_user_sans_service', '_controller' => 'App\\Controller\\Crud\\CrudUserController::sansService'], null, ['GET' => 0], null, false, false, null]],
        '/crud/user/supprimer-user-inutile' => [[['_route' => 'app_crud_user_supprimer_user_inutile', '_controller' => 'App\\Controller\\Crud\\CrudUserController::supprimer_user_inutile'], null, ['POST' => 0], null, false, false, null]],
        '/crud/user/new' => [[['_route' => 'app_crud_user_new', '_controller' => 'App\\Controller\\Crud\\CrudUserController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/user/check' => [[['_route' => 'app_crud_user_check', '_controller' => 'App\\Controller\\Crud\\CrudUserController::check'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/user/check-and-confirme' => [[['_route' => 'app_crud_user_check_and_confirme', '_controller' => 'App\\Controller\\Crud\\CrudUserController::check_and_confirme'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/user/find_number_not_have_lid' => [[['_route' => 'app_crud_user_find_number_not_have_lid', '_controller' => 'App\\Controller\\Crud\\CrudUserController::findNumberNotHaveLid'], null, ['GET' => 0], null, false, false, null]],
        '/crud/user/number_and_lid' => [[['_route' => 'app_crud_user_number_and_lid', '_controller' => 'App\\Controller\\Crud\\CrudUserController::numberAndLid'], null, ['POST' => 0], null, false, false, null]],
        '/crud/user/purge' => [[['_route' => 'app_crud_user_purge', '_controller' => 'App\\Controller\\Crud\\CrudUserController::purge'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/user/banned' => [[['_route' => 'app_crud_user_banned', '_controller' => 'App\\Controller\\Crud\\CrudUserController::banned'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/user/banned-liste' => [[['_route' => 'app_crud_user_banned_liste', '_controller' => 'App\\Controller\\Crud\\CrudUserController::banned_liste'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/crud/tuto' => [[['_route' => 'app_tuto_index', '_controller' => 'App\\Controller\\Crud\\TutoController::index'], null, ['GET' => 0], null, true, false, null]],
        '/crud/tuto/new' => [[['_route' => 'app_tuto_new', '_controller' => 'App\\Controller\\Crud\\TutoController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/historique/programme/recompense' => [[['_route' => 'app_historique_programme_recompense_index', '_controller' => 'App\\Controller\\HistoriqueProgrammeRecompenseController::index'], null, ['GET' => 0], null, true, false, null]],
        '/historique/programme/recompense/new' => [[['_route' => 'app_historique_programme_recompense_new', '_controller' => 'App\\Controller\\HistoriqueProgrammeRecompenseController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/preuve' => [[['_route' => 'app_preuve_index', '_controller' => 'App\\Controller\\PreuveController::index'], null, ['GET' => 0], null, true, false, null]],
        '/preuve/new' => [[['_route' => 'app_preuve_new', '_controller' => 'App\\Controller\\PreuveController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/export_vcf' => [[['_route' => 'app_export_vcf', '_controller' => 'App\\Controller\\PrivateController::export_vcf'], null, null, null, false, false, null]],
        '/export_csv' => [[['_route' => 'app_export_csv', '_controller' => 'App\\Controller\\PrivateController::export_csv'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\PrivateController::logout'], null, null, null, false, false, null]],
        '/confirmer-votre-mail' => [[['_route' => 'app_confirmer_mail_web', '_controller' => 'App\\Controller\\PrivateController::confirmerMailWeb'], null, null, null, false, false, null]],
        '/private' => [[['_route' => 'app_private', '_controller' => 'App\\Controller\\PrivateController::index'], null, null, null, false, false, null]],
        '/admin' => [[['_route' => 'app_admin', '_controller' => 'App\\Controller\\PrivateController::admin'], null, null, null, false, false, null]],
        '/actu' => [[['_route' => 'app_actu', '_controller' => 'App\\Controller\\PrivateController::actu'], null, null, null, false, false, null]],
        '/contact' => [[['_route' => 'app_contact', '_controller' => 'App\\Controller\\PrivateController::contact'], null, null, null, false, false, null]],
        '/contacts/guide-import' => [[['_route' => 'app_guide_import_contacts', '_controller' => 'App\\Controller\\PrivateController::guideImportContacts'], null, null, null, false, false, null]],
        '/services' => [[['_route' => 'app_hub_services', '_controller' => 'App\\Controller\\PrivateController::hubServices'], null, null, null, false, false, null]],
        '/preferences' => [[['_route' => 'app_hub_preferences', '_controller' => 'App\\Controller\\PrivateController::hubPreferences'], null, null, null, false, false, null]],
        '/parametres' => [[['_route' => 'app_hub_parametres', '_controller' => 'App\\Controller\\PrivateController::hubParametres'], null, null, null, false, false, null]],
        '/code-partenaire' => [[['_route' => 'app_code_partenaire', '_controller' => 'App\\Controller\\PrivateController::codePartenaire'], null, null, null, false, false, null]],
        '/espace-partenaire' => [[['_route' => 'app_espace_partenaire', '_controller' => 'App\\Controller\\PrivateController::espacePartenaire'], null, null, null, false, false, null]],
        '/notifications' => [[['_route' => 'app_notifications', '_controller' => 'App\\Controller\\PrivateController::notifications'], null, null, null, false, false, null]],
        '/tutoriels' => [[['_route' => 'app_tutoriels', '_controller' => 'App\\Controller\\PrivateController::tutoriels'], null, null, null, false, false, null]],
        '/assistant' => [[['_route' => 'app_assistant', '_controller' => 'App\\Controller\\PrivateController::assistant'], null, null, null, false, false, null]],
        '/newpromoreseau' => [[['_route' => 'app_newpromoreseau', '_controller' => 'App\\Controller\\PrivateController::newpromoreseau'], null, null, null, false, false, null]],
        '/listepromoreseau' => [[['_route' => 'app_listepromoreseau', '_controller' => 'App\\Controller\\PrivateController::listepromoreseau'], null, null, null, false, false, null]],
        '/vendeur/adhesion' => [[['_route' => 'app_vendeur_adhesion', '_controller' => 'App\\Controller\\PrivateController::vendeurAdhesion'], null, null, null, false, false, null]],
        '/vendeur/recharge' => [[['_route' => 'app_vendeur_recharge', '_controller' => 'App\\Controller\\PrivateController::vendeurRecharge'], null, null, null, false, false, null]],
        '/newpromoaffaire' => [[['_route' => 'app_newpromoaffaire', '_controller' => 'App\\Controller\\PrivateController::newpromoaffaire'], null, null, null, false, false, null]],
        '/listepromoaffaire' => [[['_route' => 'app_listepromoaffaire', '_controller' => 'App\\Controller\\PrivateController::listepromoaffaire'], null, null, null, false, false, null]],
        '/accepterSansSuite' => [[['_route' => 'app_accepterSansSuite', '_controller' => 'App\\Controller\\PrivateController::accepterSansSuite'], null, null, null, false, false, null]],
        '/editprofil' => [[['_route' => 'app_editprofil', '_controller' => 'App\\Controller\\PrivateController::editprofil'], null, null, null, false, false, null]],
        '/partagerDressur' => [[['_route' => 'app_partagerDressur', '_controller' => 'App\\Controller\\PrivateController::partagerDressur'], null, null, null, false, false, null]],
        '/editPassword' => [[['_route' => 'app_editPassword', '_controller' => 'App\\Controller\\PrivateController::editPassword'], null, null, null, false, false, null]],
        '/newboostcontact' => [[['_route' => 'app_newboostcontact', '_controller' => 'App\\Controller\\PrivateController::newboostcontact'], null, null, null, false, false, null]],
        '/listeboostcontact' => [[['_route' => 'app_listeboostcontact', '_controller' => 'App\\Controller\\PrivateController::listeboostcontact'], null, null, null, false, false, null]],
        '/addSuggestion' => [[['_route' => 'app_addSuggestion', '_controller' => 'App\\Controller\\PrivateController::addSuggestion'], null, null, null, false, false, null]],
        '/signalerUser' => [[['_route' => 'app_signalerUser', '_controller' => 'App\\Controller\\PrivateController::signalerUser'], null, null, null, false, false, null]],
        '/preferencePays' => [[['_route' => 'app_preferencePays', '_controller' => 'App\\Controller\\PrivateController::preferencePays'], null, null, null, false, false, null]],
        '/centreInteret' => [[['_route' => 'app_centreInteret', '_controller' => 'App\\Controller\\PrivateController::centreInteret'], null, null, null, false, false, null]],
        '/support' => [[['_route' => 'app_support', '_controller' => 'App\\Controller\\PrivateController::support'], null, null, null, false, false, null]],
        '/apropos' => [[['_route' => 'app_apropos', '_controller' => 'App\\Controller\\PrivateController::apropos'], null, null, null, false, false, null]],
        '/deleteCompte' => [[['_route' => 'app_deleteCompte', '_controller' => 'App\\Controller\\PrivateController::deleteCompte'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_public', '_controller' => 'App\\Controller\\PublicController::index'], null, null, null, false, false, null]],
        '/inscription' => [[['_route' => 'app_inscription', '_controller' => 'App\\Controller\\PublicController::inscription'], null, null, null, false, false, null]],
        '/connexion' => [[['_route' => 'app_connexion', '_controller' => 'App\\Controller\\PublicController::connexion'], null, null, null, false, false, null]],
        '/mot-de-passe-oublier' => [[['_route' => 'app_mot_de_passe_oublier', '_controller' => 'App\\Controller\\PublicController::mot_de_passe_oublier'], null, null, null, false, false, null]],
        '/contacts' => [[['_route' => 'app_contactez_nous', '_controller' => 'App\\Controller\\PublicController::contactez_nous'], null, null, null, false, false, null]],
        '/politique-confidentialite' => [[['_route' => 'politique_confidentialite', '_controller' => 'App\\Controller\\PublicController::politiqueConfidentialite'], null, null, null, false, false, null]],
        '/conditions-utilisation' => [[['_route' => 'app_conditions_utilisation', '_controller' => 'App\\Controller\\PublicController::conditionsUtilisation'], null, null, null, false, false, null]],
        '/tarifs' => [[['_route' => 'app_tarifs', '_controller' => 'App\\Controller\\PublicController::tarifs'], null, null, null, false, false, null]],
        '/actualite' => [[['_route' => 'app_actualite', '_controller' => 'App\\Controller\\PublicController::actualite'], null, null, null, false, false, null]],
        '/actualite/more' => [[['_route' => 'app_actualite_more', '_controller' => 'App\\Controller\\PublicController::actualiteMore'], null, null, null, false, false, null]],
        '/dressur-bot' => [[['_route' => 'app_dressur_bot', '_controller' => 'App\\Controller\\PublicController::dressur_bot'], null, null, null, false, false, null]],
        '/boost-contact' => [[['_route' => 'app_boost_contact', '_controller' => 'App\\Controller\\PublicController::boost_contact'], null, null, null, false, false, null]],
        '/promotion-affaire' => [[['_route' => 'app_promotion_affaire', '_controller' => 'App\\Controller\\PublicController::promotion_affaire'], null, null, null, false, false, null]],
        '/promotion-reseaux-sociaux' => [[['_route' => 'app_promotion_reseaux_sociaux', '_controller' => 'App\\Controller\\PublicController::promotion_reseau_sociaux'], null, null, null, false, false, null]],
        '/services-all' => [[['_route' => 'app_services', '_controller' => 'App\\Controller\\PublicController::services'], null, null, null, false, false, null]],
        '/sitemap.xml' => [[['_route' => 'app_sitemap', '_format' => 'xml', '_controller' => 'App\\Controller\\PublicController::sitemap'], null, null, null, false, false, null]],
        '/export/database' => [[['_route' => 'export_database', '_controller' => 'App\\Controller\\ExportDatabase::exportDatabase'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/pr(?'
                    .'|omotion\\-reseaux\\-sociaux/(?'
                        .'|([A-Za-z0-9_-]+)(*:58)'
                        .'|service/([A-Za-z0-9_-]+)(*:89)'
                    .')'
                    .'|euve/([^/]++)(?'
                        .'|(*:113)'
                        .'|/(?'
                            .'|edit(*:129)'
                            .'|accept(*:143)'
                            .'|refuse(*:157)'
                        .')'
                        .'|(*:166)'
                    .')'
                .')'
                .'|/a(?'
                    .'|pi/(?'
                        .'|get(?'
                            .'|ContactActuUser/([^/]++)(*:217)'
                            .'|AddPageActu/([^/]++)(*:245)'
                        .')'
                        .'|ad(?'
                            .'|dTousUserContact/([^/]++)/([^/]++)(*:293)'
                            .'|min/(?'
                                .'|promos/([^/]++)/(?'
                                    .'|accepter(*:335)'
                                    .'|refuser(*:350)'
                                .')'
                                .'|force\\-process/([^/]++)(*:382)'
                            .')'
                        .')'
                        .'|list(?'
                            .'|Boost/([^/]++)/([^/]++)(*:422)'
                            .'|ContactDS/([^/]++)/([^/]++)(*:457)'
                            .'|P(?'
                                .'|romo(?'
                                    .'|tion/([^/]++)/([^/]++)(*:498)'
                                    .'|Reseau/([^/]++)/([^/]++)(*:530)'
                                .')'
                                .'|aysChoisies/([^/]++)/([^/]++)(*:568)'
                            .')'
                        .')'
                        .'|set(?'
                            .'|PromotionToWatch/([^/]++)/([^/]++)(*:618)'
                            .'|MultiplePromotionsToWatch/([^/]++)(*:660)'
                        .')'
                        .'|purge_ds_by_user_id/([^/]++)(*:697)'
                        .'|del_user_qui_bouge_pas/([^/]++)(*:736)'
                        .'|update(?'
                            .'|UserPaysChoisies/([^/]++)/([^/]++)/([^/]++)(*:796)'
                            .'|AddPageActu/([^/]++)/([^/]++)(*:833)'
                        .')'
                        .'|w(?'
                            .'|hd/([^/]++)(*:857)'
                            .'|fd/([^/]++)(*:876)'
                            .'|kp(?'
                                .'|/([^/]++)(*:898)'
                                .'|\\-(?'
                                    .'|return/([^/]++)(*:926)'
                                    .'|cancel/([^/]++)(*:949)'
                                .')'
                            .')'
                        .')'
                    .')'
                    .'|ctu(?'
                        .'|/([^/]++)(*:976)'
                        .'|alite/([^/]++)(*:998)'
                    .')'
                .')'
                .'|/c(?'
                    .'|onfirmer\\-(?'
                        .'|mail/([^/]++)/([^/]++)(*:1048)'
                        .'|tel/([^/]++)/([^/]++)(*:1078)'
                    .')'
                    .'|rud/(?'
                        .'|communication\\-mail/(?'
                            .'|campagne/reactivation/([^/]++)(?'
                                .'|(*:1151)'
                                .'|/lancer(*:1167)'
                            .')'
                            .'|file\\-attente(?'
                                .'|\\-whatsapp/([^/]++)/delete(*:1219)'
                                .'|/([^/]++)/delete(*:1244)'
                            .')'
                            .'|prospects/([^/]++)/delete(*:1279)'
                        .')'
                        .'|boost/([^/]++)(?'
                            .'|(*:1306)'
                            .'|/edit(*:1320)'
                            .'|(*:1329)'
                        .')'
                        .'|deleted/d/s/([^/]++)(?'
                            .'|(*:1362)'
                            .'|/edit(*:1376)'
                            .'|(*:1385)'
                        .')'
                        .'|env(?'
                            .'|/([^/]++)(?'
                                .'|(*:1413)'
                                .'|/edit(*:1427)'
                                .'|(*:1436)'
                            .')'
                            .'|\\-(?'
                                .'|mail\\-sender/([^/]++)(?'
                                    .'|(*:1475)'
                                    .'|/edit(*:1489)'
                                    .'|(*:1498)'
                                .')'
                                .'|paiement\\-api/([^/]++)(?'
                                    .'|(*:1533)'
                                    .'|/edit(*:1547)'
                                    .'|(*:1556)'
                                .')'
                            .')'
                        .')'
                        .'|formule/(?'
                            .'|boost/([^/]++)(?'
                                .'|(*:1596)'
                                .'|/edit(*:1610)'
                                .'|(*:1619)'
                            .')'
                            .'|dressur/bot/([^/]++)(?'
                                .'|(*:1652)'
                                .'|/edit(*:1666)'
                                .'|(*:1675)'
                            .')'
                            .'|promo/(?'
                                .'|affaire/([^/]++)(?'
                                    .'|(*:1713)'
                                    .'|/edit(*:1727)'
                                    .'|(*:1736)'
                                .')'
                                .'|reseau/([^/]++)(?'
                                    .'|(*:1764)'
                                    .'|/edit(?'
                                        .'|(*:1781)'
                                        .'|\\-by\\-id\\-zef(*:1803)'
                                    .')'
                                    .'|(*:1813)'
                                .')'
                            .')'
                        .')'
                        .'|m(?'
                            .'|ethode/paiement/([^/]++)(?'
                                .'|(*:1856)'
                                .'|/edit(*:1870)'
                                .'|(*:1879)'
                            .')'
                            .'|ot/refuser/([^/]++)(?'
                                .'|(*:1911)'
                                .'|/edit(*:1925)'
                                .'|(*:1934)'
                            .')'
                        .')'
                        .'|promo(?'
                            .'|/reseau/([^/]++)(?'
                                .'|(*:1972)'
                                .'|/(?'
                                    .'|edit(*:1989)'
                                    .'|demarrage_direct_zefame(*:2021)'
                                .')'
                                .'|(*:2031)'
                            .')'
                            .'|tion/affaire/([^/]++)(?'
                                .'|(*:2065)'
                                .'|/(?'
                                    .'|edit(*:2082)'
                                    .'|accepter(*:2099)'
                                    .'|refuser(*:2115)'
                                .')'
                                .'|(*:2125)'
                            .')'
                        .')'
                        .'|s(?'
                            .'|ignalement/([^/]++)(?'
                                .'|(*:2162)'
                                .'|/edit(*:2176)'
                                .'|(*:2185)'
                            .')'
                            .'|tory/([^/]++)(?'
                                .'|(*:2211)'
                                .'|/edit(*:2225)'
                                .'|(*:2234)'
                            .')'
                            .'|uggestion/([^/]++)(?'
                                .'|(*:2265)'
                                .'|/edit(*:2279)'
                                .'|(*:2288)'
                            .')'
                        .')'
                        .'|t(?'
                            .'|ransaction/([^/]++)(?'
                                .'|(*:2325)'
                                .'|/edit(*:2339)'
                                .'|(*:2348)'
                            .')'
                            .'|uto/([^/]++)(?'
                                .'|(*:2373)'
                                .'|/edit(*:2387)'
                                .'|(*:2396)'
                            .')'
                        .')'
                        .'|user/(?'
                            .'|bot/([^/]++)(?'
                                .'|(*:2430)'
                                .'|/edit(*:2444)'
                                .'|(*:2453)'
                            .')'
                            .'|find_(?'
                                .'|whatsapp_is_activatable/([^/]++)(*:2503)'
                                .'|all_info_with_tel_user/([^/]++)(*:2543)'
                            .')'
                            .'|([^/]++)(?'
                                .'|(*:2564)'
                                .'|/(?'
                                    .'|edit(*:2581)'
                                    .'|activer(?'
                                        .'|Mail(*:2604)'
                                        .'|Tel(*:2616)'
                                    .')'
                                .')'
                                .'|(*:2627)'
                            .')'
                        .')'
                    .')'
                .')'
                .'|/historique/programme/recompense/([^/]++)(?'
                    .'|(*:2684)'
                    .'|/edit(*:2698)'
                    .'|(*:2707)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        58 => [[['_route' => 'app_promo_reseau_detail', '_controller' => 'App\\Controller\\PublicController::promoReseauDetail'], ['token'], null, null, false, true, null]],
        89 => [[['_route' => 'app_promo_reseau_service_detail', '_controller' => 'App\\Controller\\PublicController::promoReseauServiceDetail'], ['token'], null, null, false, true, null]],
        113 => [[['_route' => 'app_preuve_show', '_controller' => 'App\\Controller\\PreuveController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        129 => [[['_route' => 'app_preuve_edit', '_controller' => 'App\\Controller\\PreuveController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        143 => [[['_route' => 'app_preuve_accept', '_controller' => 'App\\Controller\\PreuveController::accept'], ['id'], ['POST' => 0], null, false, false, null]],
        157 => [[['_route' => 'app_preuve_refuse', '_controller' => 'App\\Controller\\PreuveController::refuse'], ['id'], ['POST' => 0], null, false, false, null]],
        166 => [[['_route' => 'app_preuve_delete', '_controller' => 'App\\Controller\\PreuveController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        217 => [[['_route' => 'api_getContactActuUser', '_controller' => 'App\\Controller\\API\\AddController::getContactActuUser'], ['uid'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        245 => [[['_route' => 'api_getAddPageActu', '_controller' => 'App\\Controller\\API\\UserPreferenceController::getAddPageActu'], ['uid'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        293 => [[['_route' => 'api_addTousUserContact', '_controller' => 'App\\Controller\\API\\AddController::addTousUserContact'], ['uid', 'langUserPhone'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        335 => [[['_route' => 'api_admin_promos_accepter', '_controller' => 'App\\Controller\\API\\AdminController::accepterPromo'], ['id'], ['POST' => 0], null, false, false, null]],
        350 => [[['_route' => 'api_admin_promos_refuser', '_controller' => 'App\\Controller\\API\\AdminController::refuserPromo'], ['id'], ['POST' => 0], null, false, false, null]],
        382 => [[['_route' => 'api_forceProcessTransaction', '_controller' => 'App\\Controller\\API\\WebhookController::forceProcessTransaction'], ['id'], ['POST' => 0], null, false, true, null]],
        422 => [[['_route' => 'api_listBoost', '_controller' => 'App\\Controller\\API\\BoostController::listBoost'], ['uid', 'langUserPhone'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        457 => [[['_route' => 'api_listContactDS', '_controller' => 'App\\Controller\\API\\ContactController::listContactDS'], ['uid', 'langUserPhone'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        498 => [[['_route' => 'api_listPromotion', '_controller' => 'App\\Controller\\API\\PromotionController::listPromotion'], ['uid', 'langUserPhone'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        530 => [[['_route' => 'api_listPromoReseau', '_controller' => 'App\\Controller\\API\\PromotionReseauController::listPromoReseau'], ['uid', 'langUserPhone'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        568 => [[['_route' => 'api_listPaysChoisies', '_controller' => 'App\\Controller\\API\\UserPreferenceController::listPaysChoisies'], ['uid', 'langUserPhone'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        618 => [[['_route' => 'api_setPromotionToWatch', '_controller' => 'App\\Controller\\API\\PromotionController::setPromotionToWatch'], ['id', 'uid'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        660 => [[['_route' => 'api_setMultiplePromotionsToWatch', '_controller' => 'App\\Controller\\API\\PromotionController::setMultiplePromotionsToWatch'], ['uid'], ['POST' => 0], null, false, true, null]],
        697 => [[['_route' => 'api_purge_ds_by_user_id', '_controller' => 'App\\Controller\\API\\PurgeController::purge_ds_by_user_id'], ['id'], null, null, false, true, null]],
        736 => [[['_route' => 'api_del_user_qui_bouge_pas', '_controller' => 'App\\Controller\\API\\PurgeController::del_user_qui_bouge_pas'], ['id_max'], null, null, false, true, null]],
        796 => [[['_route' => 'api_updateUserPaysChoisies', '_controller' => 'App\\Controller\\API\\UserPreferenceController::updateUserPaysChoisies'], ['uid', 'langUserPhone', 'paysChoisieJson'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        833 => [[['_route' => 'api_updateAddPageActu', '_controller' => 'App\\Controller\\API\\UserPreferenceController::updateAddPageActu'], ['uid', 'value'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        857 => [[['_route' => 'api_webhookFedaPay', '_controller' => 'App\\Controller\\API\\WebhookController::webhookFedaPay'], ['routeWebhook'], null, null, false, true, null]],
        876 => [[['_route' => 'api_webhookFeexPay', '_controller' => 'App\\Controller\\API\\WebhookController::webhookFeexPay'], ['routeWebhook'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        898 => [[['_route' => 'api_webhookKPay', '_controller' => 'App\\Controller\\API\\WebhookController::webhookKPay'], ['routeWebhook'], ['POST' => 0], null, false, true, null]],
        926 => [[['_route' => 'api_webhookKPayReturn', '_controller' => 'App\\Controller\\API\\WebhookController::webhookKPayReturn'], ['routeWebhook'], ['GET' => 0], null, false, true, null]],
        949 => [[['_route' => 'api_webhookKPayCancel', '_controller' => 'App\\Controller\\API\\WebhookController::webhookKPayCancel'], ['routeWebhook'], ['GET' => 0], null, false, true, null]],
        976 => [[['_route' => 'app_actu_detail', '_controller' => 'App\\Controller\\PrivateController::actualite'], ['token'], null, null, false, true, null]],
        998 => [[['_route' => 'app_actualite_detail', '_controller' => 'App\\Controller\\PublicController::actualiteDetail'], ['token'], null, null, false, true, null]],
        1048 => [[['_route' => 'app_confirm_mail', '_controller' => 'App\\Controller\\ConfirmMailController::confirm'], ['uid', 'token'], ['GET' => 0], null, false, true, null]],
        1078 => [[['_route' => 'app_confirm_tel', '_controller' => 'App\\Controller\\ConfirmTelController::confirm'], ['uid', 'token'], ['GET' => 0], null, false, true, null]],
        1151 => [[['_route' => 'app_communication_mail_campagne_reactivation', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::campagneReactivation'], ['type'], ['GET' => 0], null, false, true, null]],
        1167 => [[['_route' => 'app_communication_mail_campagne_reactivation_lancer', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::lancerReactivation'], ['type'], ['POST' => 0], null, false, false, null]],
        1219 => [[['_route' => 'app_communication_mail_file_attente_whatsapp_delete', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::deleteFileAttenteWhatsapp'], ['id'], ['POST' => 0], null, false, false, null]],
        1244 => [[['_route' => 'app_communication_mail_file_attente_delete', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::deleteFileAttente'], ['id'], ['POST' => 0], null, false, false, null]],
        1279 => [[['_route' => 'app_communication_mail_prospect_delete', '_controller' => 'App\\Controller\\Crud\\CommunicationMailController::deleteProspect'], ['id'], ['POST' => 0], null, false, false, null]],
        1306 => [[['_route' => 'app_crud_boost_show', '_controller' => 'App\\Controller\\Crud\\CrudBoostController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1320 => [[['_route' => 'app_crud_boost_edit', '_controller' => 'App\\Controller\\Crud\\CrudBoostController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1329 => [[['_route' => 'app_crud_boost_delete', '_controller' => 'App\\Controller\\Crud\\CrudBoostController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1362 => [[['_route' => 'app_crud_deleted_d_s_show', '_controller' => 'App\\Controller\\Crud\\CrudDeletedDSController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1376 => [[['_route' => 'app_crud_deleted_d_s_edit', '_controller' => 'App\\Controller\\Crud\\CrudDeletedDSController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1385 => [[['_route' => 'app_crud_deleted_d_s_delete', '_controller' => 'App\\Controller\\Crud\\CrudDeletedDSController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1413 => [[['_route' => 'app_crud_env_show', '_controller' => 'App\\Controller\\Crud\\CrudEnvController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1427 => [[['_route' => 'app_crud_env_edit', '_controller' => 'App\\Controller\\Crud\\CrudEnvController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1436 => [[['_route' => 'app_crud_env_delete', '_controller' => 'App\\Controller\\Crud\\CrudEnvController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1475 => [[['_route' => 'app_crud_env_mail_sender_show', '_controller' => 'App\\Controller\\Crud\\CrudEnvMailSenderController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1489 => [[['_route' => 'app_crud_env_mail_sender_edit', '_controller' => 'App\\Controller\\Crud\\CrudEnvMailSenderController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1498 => [[['_route' => 'app_crud_env_mail_sender_delete', '_controller' => 'App\\Controller\\Crud\\CrudEnvMailSenderController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1533 => [[['_route' => 'app_env_paiement_api_show', '_controller' => 'App\\Controller\\Crud\\CrudEnvPaiementApiController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1547 => [[['_route' => 'app_env_paiement_api_edit', '_controller' => 'App\\Controller\\Crud\\CrudEnvPaiementApiController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1556 => [[['_route' => 'app_env_paiement_api_delete', '_controller' => 'App\\Controller\\Crud\\CrudEnvPaiementApiController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1596 => [[['_route' => 'app_crud_formule_boost_show', '_controller' => 'App\\Controller\\Crud\\CrudFormuleBoostController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1610 => [[['_route' => 'app_crud_formule_boost_edit', '_controller' => 'App\\Controller\\Crud\\CrudFormuleBoostController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1619 => [[['_route' => 'app_crud_formule_boost_delete', '_controller' => 'App\\Controller\\Crud\\CrudFormuleBoostController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1652 => [[['_route' => 'app_crud_formule_dressur_bot_show', '_controller' => 'App\\Controller\\Crud\\CrudFormuleDressurBotController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1666 => [[['_route' => 'app_crud_formule_dressur_bot_edit', '_controller' => 'App\\Controller\\Crud\\CrudFormuleDressurBotController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1675 => [[['_route' => 'app_crud_formule_dressur_bot_delete', '_controller' => 'App\\Controller\\Crud\\CrudFormuleDressurBotController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1713 => [[['_route' => 'app_crud_formule_promo_affaire_show', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoAffaireController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1727 => [[['_route' => 'app_crud_formule_promo_affaire_edit', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoAffaireController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1736 => [[['_route' => 'app_crud_formule_promo_affaire_delete', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoAffaireController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1764 => [[['_route' => 'app_crud_formule_promo_reseau_show', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoReseauController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1781 => [[['_route' => 'app_crud_formule_promo_reseau_edit', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoReseauController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1803 => [[['_route' => 'app_crud_formule_promo_reseau_edit_by_id_zef', 'idzef' => null, '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoReseauController::edit_by_id_zef'], ['idzef'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1813 => [[['_route' => 'app_crud_formule_promo_reseau_delete', '_controller' => 'App\\Controller\\Crud\\CrudFormulePromoReseauController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1856 => [[['_route' => 'app_methode_paiement_show', '_controller' => 'App\\Controller\\Crud\\CrudMethodePaiementController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1870 => [[['_route' => 'app_methode_paiement_edit', '_controller' => 'App\\Controller\\Crud\\CrudMethodePaiementController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1879 => [[['_route' => 'app_methode_paiement_delete', '_controller' => 'App\\Controller\\Crud\\CrudMethodePaiementController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1911 => [[['_route' => 'app_crud_mot_refuser_show', '_controller' => 'App\\Controller\\Crud\\CrudMotRefuserController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1925 => [[['_route' => 'app_crud_mot_refuser_edit', '_controller' => 'App\\Controller\\Crud\\CrudMotRefuserController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1934 => [[['_route' => 'app_crud_mot_refuser_delete', '_controller' => 'App\\Controller\\Crud\\CrudMotRefuserController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        1972 => [[['_route' => 'app_crud_promo_reseau_show', '_controller' => 'App\\Controller\\Crud\\CrudPromoReseauController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1989 => [[['_route' => 'app_crud_promo_reseau_edit', '_controller' => 'App\\Controller\\Crud\\CrudPromoReseauController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2021 => [[['_route' => 'app_crud_promo_reseau_demarrage_direct_zefame', '_controller' => 'App\\Controller\\Crud\\CrudPromoReseauController::demarrage_direct_zefame'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2031 => [[['_route' => 'app_crud_promo_reseau_delete', '_controller' => 'App\\Controller\\Crud\\CrudPromoReseauController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        2065 => [[['_route' => 'app_crud_promotion_show', '_controller' => 'App\\Controller\\Crud\\CrudPromotionController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2082 => [[['_route' => 'app_crud_promotion_edit', '_controller' => 'App\\Controller\\Crud\\CrudPromotionController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2099 => [[['_route' => 'app_crud_promotion_accepter', '_controller' => 'App\\Controller\\Crud\\CrudPromotionController::accepter'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2115 => [[['_route' => 'app_crud_promotion_refuser', '_controller' => 'App\\Controller\\Crud\\CrudPromotionController::refuser'], ['id'], ['POST' => 0], null, false, false, null]],
        2125 => [[['_route' => 'app_crud_promotion_delete', '_controller' => 'App\\Controller\\Crud\\CrudPromotionController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        2162 => [[['_route' => 'app_crud_signalement_show', '_controller' => 'App\\Controller\\Crud\\CrudSignalementController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2176 => [[['_route' => 'app_crud_signalement_edit', '_controller' => 'App\\Controller\\Crud\\CrudSignalementController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2185 => [[['_route' => 'app_crud_signalement_delete', '_controller' => 'App\\Controller\\Crud\\CrudSignalementController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        2211 => [[['_route' => 'app_crud_story_show', '_controller' => 'App\\Controller\\Crud\\CrudStoryController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2225 => [[['_route' => 'app_crud_story_edit', '_controller' => 'App\\Controller\\Crud\\CrudStoryController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2234 => [[['_route' => 'app_crud_story_delete', '_controller' => 'App\\Controller\\Crud\\CrudStoryController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        2265 => [[['_route' => 'app_crud_suggestion_show', '_controller' => 'App\\Controller\\Crud\\CrudSuggestionController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2279 => [[['_route' => 'app_crud_suggestion_edit', '_controller' => 'App\\Controller\\Crud\\CrudSuggestionController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2288 => [[['_route' => 'app_crud_suggestion_delete', '_controller' => 'App\\Controller\\Crud\\CrudSuggestionController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        2325 => [[['_route' => 'app_crud_transaction_show', '_controller' => 'App\\Controller\\Crud\\CrudTransactionController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2339 => [[['_route' => 'app_crud_transaction_edit', '_controller' => 'App\\Controller\\Crud\\CrudTransactionController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2348 => [[['_route' => 'app_crud_transaction_delete', '_controller' => 'App\\Controller\\Crud\\CrudTransactionController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        2373 => [[['_route' => 'app_tuto_show', '_controller' => 'App\\Controller\\Crud\\TutoController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2387 => [[['_route' => 'app_tuto_edit', '_controller' => 'App\\Controller\\Crud\\TutoController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2396 => [[['_route' => 'app_tuto_delete', '_controller' => 'App\\Controller\\Crud\\TutoController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        2430 => [[['_route' => 'app_crud_user_bot_show', '_controller' => 'App\\Controller\\Crud\\CrudUserBotController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2444 => [[['_route' => 'app_crud_user_bot_edit', '_controller' => 'App\\Controller\\Crud\\CrudUserBotController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2453 => [[['_route' => 'app_crud_user_bot_delete', '_controller' => 'App\\Controller\\Crud\\CrudUserBotController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        2503 => [[['_route' => 'app_crud_user_find_whatsapp_is_activatable', '_controller' => 'App\\Controller\\Crud\\CrudUserController::find_whatsapp_is_activatable'], ['lid'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2543 => [[['_route' => 'app_crud_user_find_all_info_with_tel_user', '_controller' => 'App\\Controller\\Crud\\CrudUserController::find_all_info_with_tel_user'], ['search'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2564 => [[['_route' => 'app_crud_user_show', '_controller' => 'App\\Controller\\Crud\\CrudUserController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2581 => [[['_route' => 'app_crud_user_edit', '_controller' => 'App\\Controller\\Crud\\CrudUserController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2604 => [[['_route' => 'app_crud_user_activerMail', '_controller' => 'App\\Controller\\Crud\\CrudUserController::activerMail'], ['id'], ['POST' => 0], null, false, false, null]],
        2616 => [[['_route' => 'app_crud_user_activerTel', '_controller' => 'App\\Controller\\Crud\\CrudUserController::activerTel'], ['id'], ['POST' => 0], null, false, false, null]],
        2627 => [[['_route' => 'app_crud_user_delete', '_controller' => 'App\\Controller\\Crud\\CrudUserController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        2684 => [[['_route' => 'app_historique_programme_recompense_show', '_controller' => 'App\\Controller\\HistoriqueProgrammeRecompenseController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2698 => [[['_route' => 'app_historique_programme_recompense_edit', '_controller' => 'App\\Controller\\HistoriqueProgrammeRecompenseController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2707 => [
            [['_route' => 'app_historique_programme_recompense_delete', '_controller' => 'App\\Controller\\HistoriqueProgrammeRecompenseController::delete'], ['id'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
