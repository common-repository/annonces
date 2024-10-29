/**
 * Ce fichier "init.js" est obligatoire et son nom est très important pour faire fonctionné la lib JS de EO-Framework.
 *
 * Elle permet d'initialisé un sous objet dans l'objet eoxiaJS.
 * Tout plugin utilisant EO-Framework doit initialiser ce sous objet.
 *
 * Tous vos modules doivent déclarer un sous-sous objet pour être utiliser.
 * @see /module/hello-world/asset/js/hello-world.backend.js
 *
 * Cette façon de faire permet d'éviter tout conflit entre différent plugin. Il faut considérer que cette méthode
 * permet de gérer vos JS dans un namespace ou aucun plugin pourra rentrer en conflit.
 *
 * Prenons comme exemple le plugin TaskManager et DigiRisk; Voici leurs namespace:
 *
 * window.eoxiaJS.TaskManager
 * window.eoxiaJS.digiRisk
 *
 * Ensuite sous ses namespaces, vous pouvez y faire tout ce que vous voulez, et le plus,
 * vous pouvez même communiquer entre différent namespace d'un plugin à l'autre.
 *
 * @since 2.0.0
 */
window.eoxiaJS.annonces = {};
