module.exports = {

    // ##########  Base maps - backgrounds  ##########

    mapbox_streets:  window.WebMapping.Leaflet.mapbox_layer('streets', Locale.getLabel('mapping.layers.mapbox_streets')),
    mapbox_light:  window.WebMapping.Leaflet.mapbox_layer('light', Locale.getLabel('mapping.layers.mapbox_light')),
    mapbox_satellite:  window.WebMapping.Leaflet.mapbox_layer('satellite', Locale.getLabel('mapping.layers.mapbox_satellite')),

    // ##########  Rasters  ##########

    comifac:  window.WebMapping.Leaflet.mapproxy_wms('comifac', Locale.getLabel('mapping.layers.comifac'),{
        attribution: '<div style="width: 800px;">' +
                    '<b>Image source de base :</b> Verhegghen, A., Mayaux, P., de Wasseige, C., and Defourny, P.: ' +
                    'Mapping Congo Basin vegetation types from 300 m and 1 km multi-sensor time series for carbon stocks' +
                    ' and forest areas estimation, Biogeosciences, 9, 5061-5079, doi:10.5194/bg-9-5061-2012, 2012. ' +
                    '<a target="_blank" href="http://www.biogeosciences.net/9/5061/2012/bg-9-5061-2012.html">biogeosciences.net</a>'+
                    '<br/><b>Données sources ajoutées :</b> SRTM de la Nasa, OSM et OFAC'+
                    '<br/><b>Traitée :</b> Mai 2015, <a target="_blank" href="/docs/atlas/mapsteps.pdf">Etapes de réalisation</a></div>',
    }),
    spotvgt:  window.WebMapping.Leaflet.mapproxy_wms('spotvgt', Locale.getLabel('mapping.layers.spotvgt')),
    modis:  window.WebMapping.Leaflet.mapproxy_wms('modis', Locale.getLabel('mapping.layers.modis')),
    srtm:  window.WebMapping.Leaflet.mapproxy_wms('srtm', Locale.getLabel('mapping.layers.srtm')),
    glc2000:  window.WebMapping.Leaflet.mapproxy_wms('glc2000', Locale.getLabel('mapping.layers.glc2000')),
    congo_basin_vegetation_map:  window.WebMapping.Leaflet.mapproxy_wms('congo_basin_vegetation_map', Locale.getLabel('mapping.layers.congo_basin_vegetation_map')),
    total_carbon:  window.WebMapping.Leaflet.mapproxy_wms('total_carbon', Locale.getLabel('mapping.layers.total_carbon')),

    // ##########  External Resources  ##########

    tree_cover: window.Leaflet.tileLayer.wms("http://50.18.182.188:6080/arcgis/services/TreeCover2000/ImageServer/WMSServer?", {
        layers: '0',
        format: 'image/png',
        transparent: true,
        attribution: 'Hansen/UMD/Google/USGS/NASA, Accessed through <a href="https://www.globalforestwatch.org" target="_blank">Global Forest Watch</a>',
        label: 'Tree Cover (2000-2010)',
        abstract: encodeURI('Hansen, M. C., P. V. Potapov, R. Moore, M. Hancher, S. A. Turubanova, A. Tyukavina, D. Thau, S. V. Stehman, S. J. Goetz, ' +
            'T. R. Loveland, A. Kommareddy, A. Egorov, L. Chini, C. O. Justice, and J. R. G. Townshend. 2013. <b>“High-Resolution Global Maps of 21st-Century Forest Cover Change.”</b> ' +
            'Science 342 (15 November): 850–53. Data available on-line from: <a href="https://glad.umd.edu/dataset/global-2010-tree-cover-30-m" target="_blank">https://glad.umd.edu/dataset/global-2010-tree-cover-30-m</a>. ' +
            'Accessed through <a href="https://www.globalforestwatch.org" target="_blank">Global Forest Watch</a>')
    }),
    intact_forest: window.Leaflet.tileLayer('https://storage.googleapis.com/earthenginepartners-hansen/tiles/intact_forest_2016/{z}/{x}/{y}.png?', {
        attribution: '<a href="http://www.intactforests.org" target="_blank">Intact Forest Landscape (IFL)</a>',
        label: 'Intact Forest Landscapes (IFL 2000-2016)',
        abstract: encodeURI('Greenpeace, University of Maryland, World Resources Institute and Transparent World. “Intact Forest Landscapes. 2000/2013/2016” ' +
            'Accessed through <a href="https://www.globalforestwatch.org" target="_blank">Global Forest Watch</a>')
    }),

    // ##########  Overlays  ##########

    borders: window.WebMapping.Leaflet.mapserver_wms('borders', null, {}),
    landscapes: window.WebMapping.Leaflet.mapproxy_wms('landscapes', Locale.getLabel('entities.landscape', 2)),
    klc: window.WebMapping.Leaflet.mapproxy_wms('klc', Locale.getLabel('entities.klc', 2)),
    concessions: window.WebMapping.Leaflet.mapserver_wms('concessions', Locale.getLabel('form/concession.concession', 2)),
    protected_areas: window.WebMapping.Leaflet.mapproxy_wms('protected_areas', Locale.getLabel('form/protected_area.protected_area', 2))


};
