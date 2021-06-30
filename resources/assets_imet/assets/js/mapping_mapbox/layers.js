module.exports = {

    // ##########  Rasters  ##########

    comifac:  window.WebMapping.Mapbox.wms('comifac', Locale.getLabel('mapping.layers.comifac'),true, {
        attribution: '<div style="width: 800px;">' +
            '<b>Image source de base :</b> Verhegghen, A., Mayaux, P., de Wasseige, C., and Defourny, P.: ' +
            'Mapping Congo Basin vegetation types from 300 m and 1 km multi-sensor time series for carbon stocks' +
            ' and forest areas estimation, Biogeosciences, 9, 5061-5079, doi:10.5194/bg-9-5061-2012, 2012. ' +
            '<a target="_blank" href="http://www.biogeosciences.net/9/5061/2012/bg-9-5061-2012.html">biogeosciences.net</a>'+
            '<br/><b>Données sources ajoutées :</b> SRTM de la Nasa, OSM et OFAC'+
            '<br/><b>Traitée :</b> Mai 2015, <a target="_blank" href="/docs/atlas/mapsteps.pdf">Etapes de réalisation</a></div>',
    }),
    spotvgt:  window.WebMapping.Mapbox.wms('spotvgt', Locale.getLabel('mapping.layers.spotvgt'), true),
    modis:  window.WebMapping.Mapbox.wms('modis', Locale.getLabel('mapping.layers.modis'), true),
    srtm:  window.WebMapping.Mapbox.wms('srtm', Locale.getLabel('mapping.layers.srtm'), true),
    glc2000:  window.WebMapping.Mapbox.wms('glc2000', Locale.getLabel('mapping.layers.glc2000'), true),
    congo_basin_vegetation_map:  window.WebMapping.Mapbox.wms('congo_basin_vegetation_map', Locale.getLabel('mapping.layers.congo_basin_vegetation_map'), true),
    total_carbon:  window.WebMapping.Mapbox.wms('total_carbon', Locale.getLabel('mapping.layers.total_carbon'), true),
    landscapes_forest_loss_masked:  window.WebMapping.Mapbox.wms('landscapes_forest_loss_masked',
        Locale.getLabel('mapping.layers.landscapes_forest_loss_masked'), false, {
            abstract: 'From the <a target="_blank" href="http://earthenginepartners.appspot.com/science-2013-global-forest/download_v1.7.html">' +
                'Lossyear Hansen map</a> masked by the forest presence in 2000'
        }),
    landscapes_forest_mask:  window.WebMapping.Mapbox.wms('landscapes_forest_mask',
        Locale.getLabel('mapping.layers.landscapes_forest_mask'), false, {
            abstract: encodeURI('Computed with the Forest 2000 Hansen map, Forest cover more than 30% was retain as forest threshold')
        }),
    lc300_class4_1995:  window.WebMapping.Mapbox.wms('lc300_class4_1995',
        Locale.getLabel('mapping.layers.lc300_class4_1995'), false, {
            abstract: 'Reclassified in 4 classes: Cultivated Areas (+Artificial areas), Natural Areas, Mosaic Cultivated/Natural Areas, and Water/Snow'
    }),
    lc300_class4_2015:  window.WebMapping.Mapbox.wms('lc300_class4_2015',
        Locale.getLabel('mapping.layers.lc300_class4_2015'), false, {
            abstract: 'Reclassified in 4 classes: Cultivated Areas (+Artificial areas), Natural Areas, Mosaic Cultivated/Natural Areas, and Water/Snow'
        }),
    lc300_class4_2018:  window.WebMapping.Mapbox.wms('lc300_class4_2018',
        Locale.getLabel('mapping.layers.lc300_class4_2018'), false, {
            abstract: 'Reclassified in 4 classes: Cultivated Areas (+Artificial areas), Natural Areas, Mosaic Cultivated/Natural Areas, and Water/Snow'
        }),
    landscapes_lc300_1995_2015:  window.WebMapping.Mapbox.wms('landscapes_lc300_1995_2015', Locale.getLabel('mapping.layers.landscapes_lc300_1995_2015'), false),
    landscapes_lc300_2015_2018:  window.WebMapping.Mapbox.wms('landscapes_lc300_2015_2018', Locale.getLabel('mapping.layers.landscapes_lc300_2015_2018'), false),
    landscapes_above_ground_carbon:  window.WebMapping.Mapbox.wms('landscapes_above_ground_carbon',
        Locale.getLabel('mapping.layers.landscapes_above_ground_carbon'), false,{
        abstract: 'Above Ground Carbon * 0.5 (conversion factor (Biomass-> Carbon)). Water have been converted in "NoData". <br />' +
            'Santoro, M., Cartus, O., Mermoz, S., Bouvet, A., Le Toan, T., Carvalhais, N., Rozendaal, D., ' +
            'Herold, M., Avitabile, V., Quegan, S., Carreiras, J., Rauste, Y., Balzter, H., Schmullius, C., Seifert, F.M., 2018, ' +
            '<b>GlobBiomass global above-ground biomass and growing stock volume datasets</b>, available on-line ' +
            '<a target="_blank" href="http://globbiomass.org/products/global-mapping">here</a>'
    }),
    landscapes_below_ground_carbon:  window.WebMapping.Mapbox.wms('landscapes_below_ground_carbon',
        Locale.getLabel('mapping.layers.landscapes_below_ground_carbon'), false, {
            abstract: 'Above Ground Carbon map * R (Root factor (Stem Carbon -> Root Carbon)). The R factor defined ' +
                'by the <a target="_blank" href="https://www.ipcc-nggip.iges.or.jp/public/2019rf/pdf/4_Volume4/19R_V4_Ch04_Forest%20Land.pdf">' +
                '2019 Refinement to the 2006 IPCC Guidelines for National Greenhouse Gas Inventories</a>.'
        }),
    landscapes_soil_organic_carbon:  window.WebMapping.Mapbox.wms('landscapes_soil_organic_carbon',
        Locale.getLabel('mapping.layers.landscapes_soil_organic_carbon'), false,{
            abstract: '<b>Global Soil Organic Carbon Map (GSOCmap)</b> from FAO available <a target="_blank" ' +
                'href="http://54.229.242.119/GSOCmap/">here</a>'
        }),
    landscapes_total_carbon:  window.WebMapping.Mapbox.wms('landscapes_total_carbon',
        Locale.getLabel('mapping.layers.landscapes_total_carbon'), false, {
            abstract: 'Addition of the Above Ground Carbon, Below Ground Carbon and Soil Organic Carbon maps'
        }),
    landscapes_water_transitions: window.WebMapping.Mapbox.wms('landscapes_water_transitions',
        Locale.getLabel('mapping.layers.landscapes_water_transitions'), false, {
            abstract: encodeURI('Jean-Francois Pekel, Andrew Cottam, Noel Gorelick, Alan S. Belward, <b>High-resolution ' +
                'mapping of global surface water and its long-term changes.</b> Nature 540, 418-422 (2016). (doi:10.1038/nature20584)' +
                '<br />Accessed through <a href="https://global-surface-water.appspot.com/" target="_blank">Global Surface Water Explorer</a>' +
                '<br />Source: EC JRC/Google')
        }),

    // ##########  DOPA Resources  ##########

    land_cover:{
        id: 'land_cover',
        type: 'raster',
        source: window.WebMapping.Mapbox.mapbox_wms_source('https://geospatial.jrc.ec.europa.eu/geoserver/dopa_explorer_3/wms?', 'land_cover_copernicus_2018'),
        label: 'Couverture du Sol',
        abstract: '&copy; Services DOPA'
    },
    land_cover_change:{
        id: 'land_cover_change',
        type: 'raster',
        source: window.WebMapping.Mapbox.mapbox_wms_source('https://geospatial.jrc.ec.europa.eu/geoserver/dopa_explorer_3/wms?', 'LCC_1995_2015'),
        label: 'Changement d\'occupation du sol',
        abstract: '&copy; Services DOPA'
    },
    land_fragmentation: {
        id: 'land_fragmentation',
        type: 'raster',
        source: window.WebMapping.Mapbox.mapbox_wms_source('https://geospatial.jrc.ec.europa.eu/geoserver/dopa_explorer_3/wms?', 'land_fragmentation'),
        label: 'Fragmentation des terres',
        abstract: '&copy; Services DOPA'
        // abstract: 'Landscape pattern and fragmentation classes computed for the years 1995, 2000, 2005, 2010 and 2015. &copy; DOPA Services'
    },
    land_degradation: {
        id: 'land_degradation',
        type: 'raster',
        source: window.WebMapping.Mapbox.mapbox_wms_source('https://geospatial.jrc.ec.europa.eu/geoserver/dopa_explorer_3/wms?', 'LPD'),
        label: 'Dégradation des terres',
        abstract: '&copy; Services DOPA'
        // abstract: 'Changes over 15 years (1999-2013) in the health and productive capacity of the land. &copy; DOPA Services'
    },
    soil_organic_carbon: {
        id: 'soil_organic_carbon',
        type: 'raster',
        source: window.WebMapping.Mapbox.mapbox_wms_source('https://geospatial.jrc.ec.europa.eu/geoserver/dopa_explorer_3/wms?', 'soil_organic_carbon'),
        label: 'Carbone organique du sol',
        abstract: '&copy; Services DOPA'
        // abstract: 'Country statistics for the amount of soil organic carbon (0-30 cm depth). &copy; DOPA Services'
    },
    above_ground_carbon: {
        id: 'above_ground_carbon',
        type: 'raster',
        source: window.WebMapping.Mapbox.mapbox_wms_source('https://geospatial.jrc.ec.europa.eu/geoserver/dopa_explorer_3/wms?', 'above_ground_carbon'),
        label: 'Carbon au-dessous du sol',
        abstract: '&copy; Services DOPA'
        // abstract: 'Country statistics for the amount of soil organic carbon (0-30 cm depth). &copy; DOPA Services'
    },

    // ##########  Other External Resources  ##########

    water_transitions: {
        id: "water_transitions",
        type: "raster",
        source: {
            "type": "raster",
            "tiles": ["https://storage.googleapis.com/global-surface-water/tiles2019/transitions/{z}/{x}/{y}.png"],
            "attribution": 'Source: EC JRC/Google'
        },
        label:  Locale.getLabel('mapping.layers.water_transitions'),
        abstract: encodeURI('Jean-Francois Pekel, Andrew Cottam, Noel Gorelick, Alan S. Belward, <b>High-resolution ' +
            'mapping of global surface water and its long-term changes.</b> Nature 540, 418-422 (2016). (doi:10.1038/nature20584)' +
            '<br />Accessed through <a href="https://global-surface-water.appspot.com/" target="_blank">Global Surface Water Explorer</a>' +
            '<br />Source: EC JRC/Google')
    },
    tree_cover: {
        id: 'tree_cover',
        type: 'raster',
        source:{
            "type": "raster",
            "tiles": ["https://storage.googleapis.com/earthenginepartners-hansen/tiles/gfc_v1.4/tree_alpha/{z}/{x}/{y}.png"],
            //"tiles": ["https://storage.googleapis.com/wri-public/treecover/2010/{z}/{x}/{y}.png"],
            "attribution": "Hansen/UMD/Google/USGS/NASA"
        },
        label: 'Tree Cover 2000-2010',
        abstract: encodeURI('Hansen, M. C., P. V. Potapov, R. Moore, M. Hancher, S. A. Turubanova, A. Tyukavina, D. Thau, S. V. Stehman, S. J. Goetz, ' +
            'T. R. Loveland, A. Kommareddy, A. Egorov, L. Chini, C. O. Justice, and J. R. G. Townshend. 2013. <b>“High-Resolution Global Maps of 21st-Century Forest Cover Change.”</b> ' +
            'Science 342 (15 November): 850–53. <br />Data available on-line from: <a href="https://glad.umd.edu/dataset/global-2010-tree-cover-30-m" target="_blank">https://glad.umd.edu/dataset/global-2010-tree-cover-30-m</a>. ' +
            '<br />Accessed through <a href="https://www.globalforestwatch.org" target="_blank">Global Forest Watch</a>')
    },
    forest_gain: {
        id: 'forest_gain',
        type: 'raster',
        source:{
            "type": "raster",
            "tiles": ["https://storage.googleapis.com/earthenginepartners-hansen/tiles/gfc_v1.4/gain_alpha/{z}/{x}/{y}.png"],
            "attribution": "Hansen/UMD/Google/USGS/NASA"
        },
        label: 'Forest cover gain 2000–2012',
        abstract: encodeURI('Hansen, M. C., P. V. Potapov, R. Moore, M. Hancher, S. A. Turubanova, A. Tyukavina, D. Thau, S. V. Stehman, S. J. Goetz, ' +
            'T. R. Loveland, A. Kommareddy, A. Egorov, L. Chini, C. O. Justice, and J. R. G. Townshend. 2013. <b>“High-Resolution Global Maps of 21st-Century Forest Cover Change.”</b> ' +
            'Science 342 (15 November): 850–53. <br />Data available on-line from: <a href="https://glad.umd.edu/dataset/global-2010-tree-cover-30-m" target="_blank">https://glad.umd.edu/dataset/global-2010-tree-cover-30-m</a>. ' +
            '<br />Accessed through <a href="https://www.globalforestwatch.org" target="_blank">Global Forest Watch</a>')
    },
    forest_loss: {
        id: 'forest_loss',
        type: 'raster',
        source:{
            "type": "raster",
            "tiles": ["https://storage.googleapis.com/earthenginepartners-hansen/tiles/gfc_v1.7/loss_alpha/{z}/{x}/{y}.png"],
            "attribution": "Hansen/UMD/Google/USGS/NASA"
        },
        label: 'Forest cover loss 2000–2018',
        abstract: encodeURI('Hansen, M. C., P. V. Potapov, R. Moore, M. Hancher, S. A. Turubanova, A. Tyukavina, D. Thau, S. V. Stehman, S. J. Goetz, ' +
            'T. R. Loveland, A. Kommareddy, A. Egorov, L. Chini, C. O. Justice, and J. R. G. Townshend. 2013. <b>“High-Resolution Global Maps of 21st-Century Forest Cover Change.”</b> ' +
            'Science 342 (15 November): 850–53. <br />Data available on-line from: <a href="https://glad.umd.edu/dataset/global-2010-tree-cover-30-m" target="_blank">https://glad.umd.edu/dataset/global-2010-tree-cover-30-m</a>. ' +
            '<br />Accessed through <a href="https://www.globalforestwatch.org" target="_blank">Global Forest Watch</a>')
    },
    intact_forest: {
        id: "intact_forest",
        type: "raster",
        source: {
            "type": "raster",
            "tiles": ["https://storage.googleapis.com/earthenginepartners-hansen/tiles/intact_forest_2016/{z}/{x}/{y}.png"],
            "attribution": 'Map tiles by <a target="_top" rel="noopener" href="http://stamen.com">Stamen Design</a>, under <a target="_top" rel="noopener" href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a target="_top" rel="noopener" href="http://openstreetmap.org">OpenStreetMap</a>, under <a target="_top" rel="noopener" href="http://creativecommons.org/licenses/by-sa/3.0">CC BY SA</a>'
        },
        label: 'Intact Forest Landscapes (IFL 2000-2016)',
        abstract: encodeURI('Greenpeace, University of Maryland, World Resources Institute and Transparent World. “Intact Forest Landscapes. 2000/2013/2016” ' +
            'Accessed through <a href="https://www.globalforestwatch.org" target="_blank">Global Forest Watch</a>')
    },

    // ##########  Overlays  ##########
    comifac_mask:  window.WebMapping.Mapbox.wms('comifac_mask', null, true),

    comifac_eez: window.WebMapping.Mapbox.mapbox_vector_layer('comifac_eez', null, 'fill', {
        'fill-color':
            ["case",
                ["boolean", ["feature-state", "hover"], false], 'rgba(255, 255, 255, 0.3)',
                'rgba(255, 255, 255, 0)',
            ],
        'fill-outline-color': 'rgba(60, 150, 255, 0.8)'
    }),

    countries: window.WebMapping.Mapbox.mapbox_vector_layer('countries', null, 'fill', {
        'fill-color':
            ["case",
                ["boolean", ["feature-state", "hover"], false], 'rgba(255, 255, 255, 0.3)',
                'rgba(255, 255, 255, 0)',
            ],
        'fill-outline-color': 'rgba(0, 50, 0, 0.8)'
    },
    'countries'),

    landscapes: window.WebMapping.Mapbox.mapbox_vector_layer('landscapes', Locale.getLabel('mapping.platform.sites.landscapes', 2), 'fill', {
        'fill-color': 'rgb(255, 255, 0)',
        'fill-opacity':
            ["case",
                ["boolean", ["feature-state", "hover"], false], 0.8,
                0.5
            ]
    }),
    klc: window.WebMapping.Mapbox.mapbox_vector_layer('klc', Locale.getLabel('mapping.platform.sites.klc', 2), 'fill', {
        'fill-color': 'rgb(255, 155, 0)',
        'fill-opacity':
            ["case",
                ["boolean", ["feature-state", "hover"], false], 0.8,
                0.5
            ]
    }),
    concessions: window.WebMapping.Mapbox.mapbox_vector_layer('concessions', Locale.getLabel('mapping.platform.sites.concessions', 2), 'fill', {
        'fill-color': 'rgb(163, 113, 66)',
        'fill-opacity':
            ["case",
                ["boolean", ["feature-state", "hover"], false], 0.8,
                0.5
            ]
    }),
    protected_areas: window.WebMapping.Mapbox.mapbox_vector_layer('protected_areas', Locale.getLabel('mapping.platform.sites.protected_areas', 2), 'fill', {
        'fill-color': 'rgb(0, 115, 40)',
        'fill-opacity':
            ["case",
                ["boolean", ["feature-state", "hover"], false], 0.8,
                0.5
            ]
    },
    'protected_areas')


};
