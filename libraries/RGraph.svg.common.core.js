// version: 2017-01-10-174627
    /**
    * o--------------------------------------------------------------------------------o
    * | This file is part of the RGraph package - you can learn more at:               |
    * |                                                                                |
    * |                          http://www.rgraph.net                                 |
    * |                                                                                |
    * | RGraph is licensed under the Open Source MIT license. That means that it's     |
    * | totally free to use!                                                           |
    * o--------------------------------------------------------------------------------o
    */

    RGraph        = window.RGraph || {isRGraph: true,isRGraphSVG: true};
    RGraph.SVG    = RGraph.SVG    || {};
    RGraph.SVG.FX = RGraph.SVG.FX || {};


// Module pattern
(function (win, doc, undefined)
{
    var RG  = RGraph,
        ua  = navigator.userAgent,
        ma  = Math;

    RG.SVG.REG = {
        store: []
    };
    
    // ObjectRegistry
    RG.SVG.OR = {objects: []};
    
    // Used to categorise trigonometery functions
    RG.SVG.TRIG        = {};
    RG.SVG.TRIG.HALFPI = ma.PI * .4999;
    RG.SVG.TRIG.PI     = RG.SVG.TRIG.HALFPI * 2;
    RG.SVG.TRIG.TWOPI  = RG.SVG.TRIG.PI * 2;

    RG.SVG.ISIE = ua.indexOf('rident') > 0;
    RG.SVG.ISFF = ua.indexOf('irefox') > 0;
    
    RG.SVG.events = [];


    RG.SVG.ISFF     = ua.indexOf('Firefox') != -1;
    RG.SVG.ISOPERA  = ua.indexOf('Opera') != -1;
    RG.SVG.ISCHROME = ua.indexOf('Chrome') != -1;
    RG.SVG.ISSAFARI = ua.indexOf('Safari') != -1 && !RG.ISCHROME;
    RG.SVG.ISWEBKIT = ua.indexOf('WebKit') != -1;

    RG.SVG.ISIE     = ua.indexOf('Trident') > 0 || navigator.userAgent.indexOf('MSIE') > 0;
    RG.SVG.ISIE6    = ua.indexOf('MSIE 6') > 0;
    RG.SVG.ISIE7    = ua.indexOf('MSIE 7') > 0;
    RG.SVG.ISIE8    = ua.indexOf('MSIE 8') > 0;
    RG.SVG.ISIE9    = ua.indexOf('MSIE 9') > 0;
    RG.SVG.ISIE10   = ua.indexOf('MSIE 10') > 0;
    RG.SVG.ISIE11UP = ua.indexOf('MSIE') == -1 && ua.indexOf('Trident') > 0;
    RG.SVG.ISIE10UP = RG.SVG.ISIE10 || RG.SVG.ISIE11UP;
    RG.SVG.ISIE9UP  = RG.SVG.ISIE9 || RG.SVG.ISIE10UP;




    //
    // Create an SVG tag
    //
    RG.SVG.createSVG = function (opt)
    {
        var container      = opt.container;

        if (container.__svg__) {
            return container.__svg__;
        }

        var svg = doc.createElementNS("http://www.w3.org/2000/svg", "svg");
            svg.setAttribute('style', 'top: 0; left: 0; position: absolute');
            svg.setAttribute('width', container.offsetWidth);
            svg.setAttribute('height', container.offsetHeight);
            svg.setAttributeNS("http://www.w3.org/2000/xmlns/", 'xmlns', 'http://www.w3.org/2000/svg');
            svg.setAttributeNS("http://www.w3.org/2000/xmlns/", "xmlns:xlink", "http://www.w3.org/1999/xlink");
        container.appendChild(svg);
        
        container.__svg__        = svg;
        container.style.position = 'relative';

        return svg;
    };








    //
    // Create a defs tag inside the SVG
    //
    RG.SVG.createDefs = function (obj)
    {
        var defs = RG.SVG.create({
            svg: obj.svg,
            type: 'defs'
        });

        obj.defs = defs;
        
        return defs;
    };








    //
    // Creates a tag depending on the args that you give
    //
    //@param opt object The options for the function
    //
    RG.SVG.create = function (opt)
    {
        var ns  = "http://www.w3.org/2000/svg",
            tag = doc.createElementNS(ns, opt.type);

        // Add the attributes
        for (var o in opt.attr) {
            if (typeof o === 'string') {
            
                var name = o;

                if (o === 'className') {
                    name = 'class';
                }
                if (opt.type === 'a' && o === 'xlink:href') {
                    tag.setAttributeNS('http://www.w3.org/1999/xlink', o, String(opt.attr[o]));
                } else {
                    tag.setAttribute(name, String(opt.attr[o]));
                }
            }
        }
        
        // Add the style
        for (var o in opt.style) {
            if (typeof o === 'string') {
                tag.style[o] = String(opt.style[o]);
            }
        }

        if (opt.parent) {
            opt.parent.appendChild(tag);
        } else {
            opt.svg.appendChild(tag);
        }

        return tag;
    };








    //
    // Draws an X axis
    //
    //@param The chart object
    //
    RG.SVG.drawXAxis = function (obj)
    {
        var prop = obj.properties;

        // Draw the axis
        if (prop.xaxis) {

            var y = obj.type === 'hbar' ? obj.height - prop.gutterBottom : obj.getYCoord(0);

            var axis = RG.SVG.create({
                svg: obj.svg,
                type: 'path',
                attr: {
                    d: 'M{1} {2} L{3} {4}'.format(
                        prop.gutterLeft,
                        y + 0.01,
                        obj.width - prop.gutterRight,
                        y
                    ),
                    fill: prop.xaxisColor,
                    stroke: prop.xaxisColor,
                    'shape-rendering': "crispEdges"
                }
            });
    

            // HBar X axis
            if (obj.type === 'hbar') {
                var width  = obj.graphWidth / obj.data.length,
                    x      = prop.gutterLeft,
                    startY = (obj.height - prop.gutterBottom),
                    endY   = (obj.height - prop.gutterBottom) + prop.xaxisTickmarksLength;
            
            // Line/Bar X axis
            } else {
                var width  = obj.graphWidth / obj.data.length,
                    x      = prop.gutterLeft,
                    startY = obj.getYCoord(0) - (prop.yaxisMin < 0 ? prop.xaxisTickmarksLength : 0),
                    endY   = obj.getYCoord(0) + prop.xaxisTickmarksLength;
            }









            // Draw the tickmarks
            if (prop.xaxisTickmarks) {
            
                // TH HBar uses a scale
                if (prop.xaxisScale) {

                    for (var i=0; i<(obj.scale.numlabels + (prop.yaxis && prop.xaxisMin === 0 ? 0 : 1)); ++i) {
                    
                        if (obj.type === 'hbar') {
                            var dataPoints = obj.data.length;
                        }
                    
                        x = prop.gutterLeft + ((i+(prop.yaxis && prop.xaxisMin === 0 ? 1 : 0)) * (obj.graphWidth / obj.scale.numlabels));
                    
                        RG.SVG.create({
                            svg: obj.svg,
                            type: 'path',
                            attr: {
                                d: 'M{1} {2} L{3} {4}'.format(
                                    x + 0.001,
                                    startY,
                                    x,
                                    endY
                                ),
                                stroke: prop.xaxisColor,
                                'shape-rendering': "crispEdges"
                            }
                        });
                    }




                } else {
                
                    // This style is used by Bar and Scatter charts
                    if (prop.xaxisLabelsPosition === 'section') {
        
                        for (var i=0; i<obj.data.length; ++i) {
                        
                            if (obj.type === 'bar') {
                                var dataPoints = obj.data.length;
                            } else if (obj.type === 'line'){
                                var dataPoints = obj.data[0].length;
                            }
        
        
                            x = prop.gutterLeft + ((i+1) * (obj.graphWidth / dataPoints));
        
                            RG.SVG.create({
                                svg: obj.svg,
                                type: 'path',
                                attr: {
                                    d: 'M{1} {2} L{3} {4}'.format(
                                        x + 0.001,
                                        startY,
                                        x,
                                        endY
                                    ),
                                    stroke: prop.xaxisColor,
                                    'shape-rendering': "crispEdges"
                                }
                            });
                        }
                    
                    // This style is used by line charts
                    } else if (prop.xaxisLabelsPosition === 'edge') {

                        if (typeof prop.xaxisLabelsPositionEdgeTickmarksCount === 'number') {
                            var len = prop.xaxisLabelsPositionEdgeTickmarksCount;
                        } else {
                            var len = obj.data && obj.data[0] && obj.data[0].length ? obj.data[0].length : 0;
                        }
    
                        for (var i=0; i<len; ++i) {

                            var gap = ( (obj.graphWidth) / (len - 1)),
                                x   = prop.gutterLeft + ((i+1) * gap);
    
                            RG.SVG.create({
                                svg: obj.svg,
                                type: 'path',
                                attr: {
                                    d: 'M{1} {2} L{3} {4}'.format(
                                        x + 0.001,
                                        startY,
                                        x,
                                        endY
                                    ),
                                    stroke: prop.xaxisColor,
                                    'shape-rendering': "crispEdges"
                                }
                            });
                        }
                    }
                }






                // Draw an extra tick if the Y axis is not being shown
                if (prop.yaxis === false) {
                    RG.SVG.create({
                        svg: obj.svg,
                        type: 'path',
                        attr: {
                            d: 'M{1} {2} L{3} {4}'.format(
                                prop.gutterLeft + 0.001,
                                startY,
                                prop.gutterLeft,
                                endY
                            ),
                            stroke: obj.properties.xaxisColor,
                            'shape-rendering': "crispEdges"
                        }
                    });
                }
            }
        }












        //
        // Draw an X axis scale
        //
        if (prop.xaxisScale) {

            var segment = obj.graphWidth / prop.xaxisLabelsCount;
            
            for (var i=0; i<obj.scale.labels.length; ++i) {
            
                var x = prop.gutterLeft + (segment * i) + segment + prop.xaxisLabelsOffsetx;

                RG.SVG.text({
                    object: obj,
                    text:   obj.scale.labels[i],
                    x:      x,
                    y:      (obj.height - prop.gutterBottom) + (prop.xaxis ? prop.xaxisTickmarksLength + 6 : 10) + prop.xaxisLabelsOffsety,
                    halign: 'center',
                    valign: 'top',
                    font:   prop.xaxisTextFont   || prop.textFont,
                    size:   prop.xaxisTextSize   || (typeof prop.textSize === 'number' ? prop.textSize + 'pt' : prop.textSize),
                    bold:   prop.xaxisTextBold   || prop.textBold,
                    italic: prop.xaxisTextItalic || prop.textItalic,
                    color:  prop.xaxisTextColor  || prop.textColor
                });
            }
            
            
            
            

            // Add the minimum label
            var y   = obj.height - prop.gutterBottom + prop.xaxisLabelsOffsety + (prop.xaxis ? prop.xaxisTickmarksLength + 6 : 10),
                str = RG.SVG.numberFormat({
                    object: obj,
                    num: prop.xaxisMin.toFixed(prop.xaxisDecimals),
                    prepend: prop.xaxisUnitsPre,
                    append: prop.xaxisUnitsPost,
                    point: prop.xaxisPoint,
                    thousand: prop.xaxisThousand,
                    formatter: prop.xaxisFormatter
                });

            var text = RG.SVG.text({
                object: obj,
                text: typeof prop.xaxisFormatter === 'function' ? (prop.xaxisFormatter)(this, prop.xaxisMin) : str,
                x: prop.gutterLeft + prop.xaxisLabelsOffsetx,
                y: y,
                halign: 'center',
                valign: 'top',
                font:   prop.xaxisTextFont   || prop.textFont,
                size:   prop.xaxisTextSize   || (typeof prop.textSize === 'number' ? prop.textSize + 'pt' : prop.textSize),
                bold:   prop.xaxisTextBold   || prop.textBold,
                italic: prop.xaxisTextItalic || prop.textItalic,
                color:  prop.xaxisTextColor  || prop.textColor
            });

        //
        // Draw the X axis labels
        //
        } else {
            if (typeof prop.xaxisLabels === 'object' && !RG.SVG.isNull(prop.xaxisLabels) ) {

                // Loop through the X labels
                if (prop.xaxisLabelsPosition === 'section') {
                
                    var segment = (obj.width - prop.gutterLeft - prop.gutterRight) / prop.xaxisLabels.length;
                
                    for (var i=0; i<prop.xaxisLabels.length; ++i) {
                    
                        var x = prop.gutterLeft + (segment / 2) + (i * segment);
        
                        RG.SVG.text({
                            object: obj,
                            text: prop.xaxisLabels[i],
                            x: x + prop.xaxisLabelsOffsetx,
                            y: obj.height - prop.gutterBottom + (RG.SVG.ISFF ? 5 : 10) + prop.xaxisLabelsOffsety,
                            valign: 'top',
                            halign: 'center',
                            size:   prop.xaxisTextSize   || prop.textSize,
                            italic: prop.xaxisTextItalic || prop.textItalic,
                            font:   prop.xaxisTextFont   || prop.textFont,
                            bold:   prop.xaxisTextBold   || prop.textBold,
                            color:  prop.xaxisTextColor  || prop.textColor
                        });
                    }
                } else if (prop.xaxisLabelsPosition === 'edge') {
    
                    if (obj.type === 'line') {
                        var hmargin = prop.hmargin;
                    } else {
                        var hmargin = 0;
                    }
    
    
    
                    var segment = (obj.graphWidth - hmargin - hmargin) / (prop.xaxisLabels.length - 1);
                    
                    for (var i=0; i<prop.xaxisLabels.length; ++i) {
                    
                        var x = prop.gutterLeft + (i * segment) + hmargin;
                    
                        RG.SVG.text({
                            object: obj,
                            text: prop.xaxisLabels[i],
                            x: x + prop.xaxisLabelsOffsetx,
                            y: obj.height - prop.gutterBottom + (RG.SVG.ISFF ? 5 : 10) + (prop.xaxisTickmarksLength - 5) + prop.xaxisLabelsOffsety,
                            valign: 'top',
                            halign: 'center',
                            size:   prop.xaxisTextSize   ||  prop.textSize,
                            italic: prop.xaxisTextItalic ||  prop.textItalic,
                            font:   prop.xaxisTextFont   ||  prop.textFont,
                            bold:   prop.xaxisTextBold   ||  prop.textBold,
                            color:  prop.xaxisTextColor  ||  prop.textColor
                        });
                    }
                }
            }
        }
    };








    //
    // Draws an Y axis
    //
    //@param The chart object
    //
    RG.SVG.drawYAxis = function (obj)
    {
        var prop = obj.properties;

        if (prop.yaxis) {

            // The X coordinate that the Y axis is positioned at
            var x = obj.type === 'hbar' ? obj.getXCoord(0) : prop.gutterLeft;

            var axis = RG.SVG.create({
                svg: obj.svg,
                type: 'path',
                attr: {
                    d: 'M{1} {2} L{3} {4}'.format(
                        x,
                        prop.gutterTop,
                        x + 0.001,
                        obj.height - prop.gutterBottom
                    ),
                    stroke: prop.yaxisColor,
                    fill: prop.yaxisColor,
                    'shape-rendering': "crispEdges"
                }
            });

    
    
    

    

            if (obj.type === 'hbar') {
                
                var height = obj.graphHeight / prop.yaxisLabels.length,
                    y      = prop.gutterTop,
                    len    = prop.yaxisLabels.length,
                    startX = obj.getXCoord(0) + (prop.xaxisMin < 0 ? prop.yaxisTickmarksLength : 0),
                    endX   = obj.getXCoord(0) - prop.yaxisTickmarksLength;

                //
                // Draw the tickmarks
                //
                if (prop.yaxisTickmarks) {
                    for (var i=0; i<len; ++i) {
    
                        // Draw the axis
                        var axis = RG.SVG.create({
                            svg: obj.svg,
                            type: 'path',
                            attr: {
                                d: 'M{1} {2} L{3} {4}'.format(
                                    startX,
                                    y,
                                    endX,
                                    y + 0.001
                                ),
                                stroke: prop.yaxisColor,
                                'shape-rendering': "crispEdges"
                            }
                        });
                        
                        y += height;
                    }
    
    
                    // Draw an extra tick if the X axis position is not zero or
                    //if the xaxis is not being shown
                    if (prop.xaxis === false) {
                        var axis = RG.SVG.create({
                            svg: obj.svg,
                            type: 'path',
                            attr: {
                                d: 'M{1} {2} L{3} {4}'.format(
                                    obj.getXCoord(0) - prop.yaxisTickmarksLength - 1,
                                    obj.height - prop.gutterBottom,
                                    obj.getXCoord(0) + (obj.type === 'hbar' && prop.xaxisMin < 0 ? 3 : 0),
                                    obj.height - prop.gutterBottom - 0.001
                                ),
                                stroke: obj.properties.yaxisColor,
                                'shape-rendering': "crispEdges"
                            }
                        });
                    }
                }

            //
            // Bar, Line etc types of chart
            //
            } else {

                var height = obj.graphHeight / prop.yaxisLabelsCount,
                    y      = prop.gutterTop,
                    len    = prop.yaxisLabelsCount,
                    startX = prop.gutterLeft,
                    endX   = prop.gutterLeft - prop.yaxisTickmarksLength;

                //
                // Draw the tickmarks
                //
                if (prop.yaxisTickmarks) {
                    for (var i=0; i<len; ++i) {

                        // Draw the axis
                        var axis = RG.SVG.create({
                            svg: obj.svg,
                            type: 'path',
                            attr: {
                                d: 'M{1} {2} L{3} {4}'.format(
                                    startX,
                                    y,
                                    endX,
                                    y + 0.001
                                ),
                                stroke: prop.yaxisColor,
                                'shape-rendering': "crispEdges"
                            }
                        });
                        
                        y += height;
                    }
    
    
                    // Draw an extra tick if the X axis position is not zero or
                    //if the xaxis is not being shown
                    if (obj.type !== 'hbar' && (prop.yaxisMin !== 0 || prop.xaxis === false)) {
                        var axis = RG.SVG.create({
                            svg: obj.svg,
                            type: 'path',
                            attr: {
                                d: 'M{1} {2} L{3} {4}'.format(
                                    prop.gutterLeft - prop.yaxisTickmarksLength,
                                    obj.height - prop.gutterBottom,
                                    prop.gutterLeft,
                                    obj.height - prop.gutterBottom - 0.001
                                ),
                                stroke: prop.yaxisColor,
                                'shape-rendering': "crispEdges"
                            }
                        });
                    }
                }
            }
        }






        //
        // Draw the Y axis labels
        //
        if (prop.yaxisScale) {

            var segment = (obj.height - prop.gutterTop - prop.gutterBottom) / prop.yaxisLabelsCount;

            for (var i=0; i<obj.scale.labels.length; ++i) {

                var y = obj.height - prop.gutterBottom - (segment * i) - segment;

                RG.SVG.text({
                    object: obj,
                    text: obj.scale.labels[i],
                    x: prop.gutterLeft - 7 - (prop.yaxis ? (prop.yaxisTickmarksLength - 3) : 0) + prop.yaxisLabelsOffsetx,
                    y: y + prop.yaxisLabelsOffsety,
                    halign: 'right',
                    valign: 'center',
                    font:   prop.yaxisTextFont   || prop.textFont,
                    size:   prop.yaxisTextSize   || (typeof prop.textSize === 'number' ? prop.textSize + 'pt' : prop.textSize),
                    bold:   prop.yaxisTextBold   || prop.textBold,
                    italic: prop.yaxisTextItalic || prop.textItalic,
                    color:  prop.yaxisTextColor  || prop.textColor
                });
            }




            //
            // Add the minimum label
            //
            var y   = obj.height - prop.gutterBottom,
                str = (prop.yaxisUnitsPre + prop.yaxisMin.toFixed(prop.yaxisDecimals).replace(/\./, prop.yaxisPoint) + prop.yaxisUnitsPost);

            var text = RG.SVG.text({
                object: obj,
                text: typeof prop.yaxisFormatter === 'function' ? (prop.yaxisFormatter)(this, prop.yaxisMin) : str,
                x: prop.gutterLeft - 7 - (prop.yaxis ? (prop.yaxisTickmarksLength - 3) : 0) + prop.yaxisLabelsOffsetx,
                y: y + prop.yaxisLabelsOffsety,
                halign: 'right',
                valign: 'center',
                font:   prop.yaxisTextFont   || prop.textFont,
                size:   prop.yaxisTextSize   || (typeof prop.textSize === 'number' ? prop.textSize + 'pt' : prop.textSize),
                bold:   prop.yaxisTextBold   || prop.textBold,
                italic: prop.yaxisTextItalic || prop.textItalic,
                color:  prop.yaxisTextColor  || prop.textColor
            });
        
        
        //
        // Draw Y axis labels (eg when specific labels are defined or
        //the chart is an HBar
        //
        } else if (prop.yaxisLabels && prop.yaxisLabels.length) {

            for (var i=0; i<prop.yaxisLabels.length; ++i) {

                var segment = obj.graphHeight / prop.yaxisLabels.length,
                    y       = prop.gutterTop + (segment * i) + (segment / 2) + prop.yaxisLabelsOffsety;

                var text = RG.SVG.text({
                    object: obj,
                    text:   prop.yaxisLabels[i] ? prop.yaxisLabels[i] : '',
                    x:      prop.gutterLeft - 7 /*- (prop.yaxis ? (prop.yaxisTickmarksLength) : 0)*/ + prop.yaxisLabelsOffsetx,
                    y:      y,
                    halign: 'right',
                    valign: 'center',
                    font:   prop.yaxisTextFont   || prop.textFont,
                    size:   prop.yaxisTextSize   || (typeof prop.textSize === 'number' ? prop.textSize + 'pt' : prop.textSize),
                    bold:   prop.yaxisTextBold   || prop.textBold,
                    italic: prop.yaxisTextItalic || prop.textItalic,
                    color:  prop.yaxisTextColor  || prop.textColor
                });
            }
        }
    };








    //
    // Draws the background
    //
    //@param The chart object
    //
    RG.SVG.drawBackground = function (obj)
    {
        var prop  = obj.properties;

        if (prop .backgroundGrid) {

            var parts = [];
    
            // Add the horizontal lines to the path
            if (prop.backgroundGridHlines) {

                var count = typeof prop.backgroundGridHlinesCount === 'number' ? prop.backgroundGridHlinesCount : (obj.type === 'hbar' ? (prop.yaxisLabels.length || obj.data.length || 5) : prop.yaxisLabelsCount);

                for (var i=0; i<count; ++i) {
                    parts.push('M{1} {2} L{3} {4}'.format(
                        prop.gutterLeft,
                        prop.gutterTop + (obj.graphHeight / count) * i,
                        obj.width - prop.gutterRight,
                        prop.gutterTop + (obj.graphHeight / count) * i
                    ));
                }

                // Add an extra background grid line to the path - this its
                // underneath the X axis and shows up if its not there.
                parts.push('M{1} {2} L{3} {4}'.format(
                    prop.gutterLeft,
                    obj.height - prop.gutterBottom,
                    obj.width - prop.gutterRight,
                    obj.height - prop.gutterBottom
                ));
            }



            // Add the vertical lines to the path
            if (prop.backgroundGridVlines) {
            
                if (obj.type === 'line' && RG.SVG.isArray(obj.data[0])) {
                    var len = obj.data[0].length;
                } else if (obj.type === 'hbar') {
                    var len = prop.xaxisLabelsCount;
                } else {
                    var len = obj.data.length;
                }

                var count = typeof prop.backgroundGridVlinesCount === 'number' ? prop.backgroundGridVlinesCount : len;

                if (prop.xaxisLabelsPosition === 'edge') {
                    count--;
                }
            
                for (var i=0; i<=count; ++i) {
                    parts.push('M{1} {2} L{3} {4}'.format(
                        prop.gutterLeft + ((obj.graphWidth / count) * i),
                        prop.gutterTop,
                        prop.gutterLeft + ((obj.graphWidth / count) * i),
                        obj.height - prop.gutterBottom
                    ));
                }
            }





            // Add the box around the grid
            if (prop.backgroundGridBorder) {
                parts.push('M{1} {2} L{3} {4} L{5} {6} L{7} {8} z'.format(
                    
                    prop.gutterLeft,
                    prop.gutterTop,
                    
                    obj.width - prop.gutterRight,
                    prop.gutterTop,
                    
                    obj.width - prop.gutterRight,
                    obj.height - prop.gutterBottom,
                    
                    prop.gutterLeft,
                    obj.height - prop.gutterBottom
                ));
            }



            // Now draw the path
            var grid = RG.SVG.create({
                svg: obj.svg,
                type: 'path',
                attr: {
                    d: parts.join(' '),
                    stroke: prop.backgroundGridColor,
                    fill: 'rgba(0,0,0,0)',
                    'stroke-width': prop.backgroundGridLinewidth,
                    'shape-rendering': "crispEdges"
                }
            });

        }



        // Draw the title and subtitle
        RG.SVG.drawTitle(obj);
    };








    /**
    * Returns true/false as to whether the given variable is null or not
    * 
    * @param mixed arg The argument to check
    */
    RG.SVG.isNull = function (arg)
    {
        // must BE DOUBLE EQUALS - NOT TRIPLE
        if (arg == null || typeof arg === 'object' && !arg) {
            return true;
        }
        
        return false;
    };








    /**
    * Returns an appropriate scale. The return value is actualy an object consisting of:
    *  scale.max
    *  scale.min
    *  scale.scale
    * 
    * @param  obj object  The graph object
    * @param  prop object An object consisting of configuration properties
    * @return     object  An object containg scale information
    */
    RG.SVG.getScale = function (opt)
    {
        var obj          = opt.object,
            prop         = obj.properties,
            numlabels    = opt.numlabels,
            unitsPre     = opt.unitsPre,
            unitsPost    = opt.unitsPost,
            max          = Number(opt.max),
            min          = Number(opt.min),
            strict       = opt.strict,
            decimals     = Number(opt.decimals),
            point        = opt.point,
            thousand     = opt.thousand,
            originalMax  = max,
            round        = opt.round,
            scale        = {max:1,labels:[],values:[]},
            formatter    = opt.formatter;


        /**
        * Special case for 0
        * 
        * ** Must be first **
        */

        if (!max) {

            var max   = 1;

            for (var i=0; i<numlabels; ++i) {

                var label = ((((max - min) / numlabels) + min) * (i + 1)).toFixed(decimals);

                scale.labels.push(unitsPre + label + unitsPost);
                scale.values.push(parseFloat(label))
            }

        /**
        * Manually do decimals
        */
        } else if (max <= 1 && !strict) {

            var arr = [
                1,0.5,
                0.10,0.05,
                0.010,0.005,
                0.0010,0.0005,
                0.00010,0.00005,
                0.000010,0.000005,
                0.0000010,0.0000005,
                0.00000010,0.00000005,
                0.000000010,0.000000005,
                0.0000000010,0.0000000005,
                0.00000000010,0.00000000005,
                0.000000000010,0.000000000005,
                0.0000000000010,0.0000000000005
            ], vals = [];



            for (var i=0; i<arr.length; ++i) {
                if (max > arr[i]) {
                    i--;
                    break;
                }
            }


            scale.max    = arr[i]
            scale.labels = [];
            scale.values = [];


            for (var j=0; j<numlabels; ++j) {
                
                var value = ((((arr[i] - min) / numlabels) * (j + 1)) + min).toFixed(decimals);

                scale.values.push(value);
                scale.labels.push(RG.SVG.numberFormat({
                    object: obj,
                    num: value,
                    prepend: unitsPre,
                    append: unitsPost,
                    point: prop.yaxisPoint,
                    thousand: prop.yaxisThousand,
                    formatter: formatter
                }));
            }




        } else if (!strict) {

            /**
            * Now comes the scale handling for integer values
            */

            // This accomodates decimals by rounding the max up to the next integer
            max = ma.ceil(max);

            var interval = ma.pow(10, ma.max(1, Number(String(Number(max) - Number(min)).length - 1)) );
            var topValue = interval;

            while (topValue < max) {
                topValue += (interval / 2);
            }

            // Handles cases where the max is (for example) 50.5
            if (Number(originalMax) > Number(topValue)) {
                topValue += (interval / 2);
            }

            // Custom if the max is greater than 5 and less than 10
            if (max <= 10) {
                topValue = (Number(originalMax) <= 5 ? 5 : 10);
            }
    
    
            // Added 02/11/2010 to create "nicer" scales
            if (obj && typeof(round) == 'boolean' && round) {
                topValue = 10 * interval;
            }

            scale.max = topValue;


            for (var i=0; i<numlabels; ++i) {

                var label = RG.SVG.numberFormat({
                    object: obj,
                    num: ((((i+1) / numlabels) * (topValue - min)) + min).toFixed(decimals),
                    prepend: unitsPre,
                    append: unitsPost,
                    point: point,
                    thousand: thousand,
                    formatter: formatter
                });

                scale.labels.push(label);
                scale.values.push(((((i+1) / numlabels) * (topValue - min)) + min).toFixed(decimals));
            }

        } else if (typeof max === 'number' && strict) {

            /**
            * ymax is set and also strict
            */
            for (var i=0; i<numlabels; ++i) {
                
                scale.labels.push(RG.SVG.numberFormat({
                    object: obj,
                    formatter: formatter,
                    num: ((((i+1) / numlabels) * (max - min)) + min).toFixed(decimals),
                    prepend: unitsPre,
                    append: unitsPost,
                    point: point,
                    thousand: thousand
                }));


                scale.values.push(
                    ((((i+1) / numlabels) * (max - min)) + min).toFixed(decimals)
                );
            }

            // ???
            scale.max = max;
        }

        
        scale.unitsPre  = unitsPre;
        scale.unitsPost = unitsPost;
        scale.point     = point;
        scale.decimals  = decimals;
        scale.thousand  = thousand;
        scale.numlabels = numlabels;
        scale.round     = Boolean(round);
        scale.min       = min;

        //
        // Convert all of the scale values to numbers
        //
        for (var i=0; i<scale.values.length; ++i) {
            scale.values[i] = parseFloat(scale.values[i]);
        }

        return scale;
    };








    /**
    * Pads/fills the array
    * 
    * @param  array arr The array
    * @param  int   len The length to pad the array to
    * @param  mixed     The value to use to pad the array (optional)
    */
    RG.SVG.arrayFill = 
    RG.SVG.arrayPad  = function (opt)
    {
        var arr   = opt.array,
            len   = opt.length,
            value = (opt.value ? opt.value : null);

        if (arr.length < len) {            
            for (var i=arr.length; i<len; i+=1) {
                arr[i] = value;
            }
        }
        
        return arr;
    };








    /**
    * An array sum function
    * 
    * @param  array arr The  array to calculate the total of
    * @return int       The summed total of the arrays elements
    */
    RG.SVG.arraySum = function (arr)
    {
        // Allow integers
        if (typeof arr === 'number') {
            return arr;
        }
        
        // Account for null
        if (RG.SVG.isNull(arr)) {
            return 0;
        }

        var i, sum, len = arr.length;

        for(i=0,sum=0;i<len;sum+=arr[i++]);

        return sum;
    };








    /**
    * Returns the maximum numeric value which is in an array. This function IS NOT
    * recursive
    * 
    * @param  array arr The array (can also be a number, in which case it's returned as-is)
    * @param  int       Whether to ignore signs (ie negative/positive)
    * @return int       The maximum value in the array
    */
    RG.SVG.arrayMax = function (arr)
    {
        var max = null
        
        if (typeof arr === 'number') {
            return arr;
        }
        
        if (RG.SVG.isNull(arr)) {
            return 0;
        }

        for (var i=0,len=arr.length; i<len; ++i) {
            if (typeof arr[i] === 'number') {

                var val = arguments[1] ? ma.abs(arr[i]) : arr[i];
                
                if (typeof max === 'number') {
                    max = ma.max(max, val);
                } else {
                    max = val;
                }
            }
        }

        return max;
    };








    /**
    * Returns the minimum numeric value which is in an array
    * 
    * @param  array arr The array (can also be a number, in which case it's returned as-is)
    * @param  int       Whether to ignore signs (ie negative/positive)
    * @return int       The minimum value in the array
    */
    RG.SVG.arrayMin = function (arr)
    {
        var max = null,
            min = null,
            ma  = Math;
        
        if (typeof arr === 'number') {
            return arr;
        }
        
        if (RG.SVG.isNull(arr)) {
            return 0;
        }

        for (var i=0,len=arr.length; i<len; ++i) {
            if (typeof arr[i] === 'number') {

                var val = arguments[1] ? ma.abs(arr[i]) : arr[i];
                
                if (typeof min === 'number') {
                    min = ma.min(min, val);
                } else {
                    min = val;
                }
            }
        }

        return min;
    };








    /**
    * Returns the maximum value which is in an array
    * 
    * @param  array arr The array
    * @param  int   len The length to pad the array to
    * @param  mixed     The value to use to pad the array (optional)
    */
    RG.SVG.arrayPad = function (arr, len)
    {
        if (arr.length < len) {
            var val = arguments[2] ? arguments[2] : null;
            
            for (var i=arr.length; i<len; i+=1) {
                arr[i] = val;
            }
        }
        
        return arr;
    };








    /**
    * An array sum function
    * 
    * @param  array arr The  array to calculate the total of
    * @return int       The summed total of the arrays elements
    */
    RG.SVG.arraySum = function (arr)
    {
        // Allow integers
        if (typeof arr === 'number') {
            return arr;
        }
        
        // Account for null
        if (RG.SVG.isNull(arr)) {
            return 0;
        }

        var i, sum, len = arr.length;

        for(i=0,sum=0;i<len;sum+=arr[i++]);

        return sum;
    };








    /**
    * Takes any number of arguments and adds them to one big linear array
    * which is then returned
    * 
    * @param ... mixed The data to linearise. You can strings, booleans, numbers or arrays
    */
    RG.SVG.arrayLinearize = function ()
    {
        var arr  = [],
            args = arguments

        for (var i=0,len=args.length; i<len; ++i) {

            if (typeof args[i] === 'object' && args[i]) {
                for (var j=0,len2=args[i].length; j<len2; ++j) {
                    var sub = RG.SVG.arrayLinearize(args[i][j]);
                    
                    for (var k=0,len3=sub.length; k<len3; ++k) {
                        arr.push(sub[k]);
                    }
                }
            } else {
                arr.push(args[i]);
            }
        }

        return arr;
    };








    /**
    * Takes one off the front of the given array and returns the new array.
    * 
    * @param array arr The array from which to take one off the front of array 
    * 
    * @return array The new array
    */
    RG.SVG.arrayShift = function(arr)
    {
        var ret = [];
        
        for(var i=1,len=arr.length; i<len; ++i) {
            ret.push(arr[i]);
        }
        
        return ret;
    };








    /**
    * Reverses the order of an array
    * 
    * @param array arr The array to reverse
    */
    RG.SVG.arrayReverse = function (arr)
    {
        if (!arr) {
            return;
        }

        var newarr=[];

        for(var i=arr.length - 1; i>=0; i-=1) {
            newarr.push(arr[i]);
        }
        
        return newarr;
    };








    /**
    * Makes a clone of an object
    * 
    * @param obj val The object to clone
    */
    RG.SVG.arrayClone = function (obj)
    {
        if(obj === null || typeof obj !== 'object') {
            return obj;
        }

        if (RG.SVG.isArray(obj)) {

            var temp = [];
    
            for (var i=0,len=obj.length;i<len; ++i) {
    
                if (typeof obj[i]  === 'number') {
                    temp[i] = (function (arg) {return Number(arg);})(obj[i]);
    
                } else if (typeof obj[i]  === 'string') {
                    temp[i] = (function (arg) {return String(arg);})(obj[i]);
                
                } else if (typeof obj[i] === 'function') {
                    temp[i] = obj[i];
                
                } else {
                    temp[i] = RG.SVG.arrayClone(obj[i]);
                }
            }
        } else if (typeof obj === 'object') {
            
            var temp = {};
            
            for (var i in obj) {
                if (typeof i === 'string') {
                    temp[i] = obj[i];
                }
            }
        }

        return temp;
    };








    //
    // Converts an the truthy values to falsey values and vice-versa
    //
    RG.SVG.arrayInvert = function (arr)
    {
        for (var i=0,len=arr.length; i<len; ++i) {
            arr[i] = !arr[i];
        }

        return arr;
    };








    //
    // An array_trim function that removes the empty elements off
    //both ends
    //
    RG.SVG.arrayTrim = function (arr)
    {
        var out = [], content = false;

        // Trim the start
        for (var i=0; i<arr.length; i++) {
        
            if (arr[i]) {
                content = true;
            }
        
            if (content) {
                out.push(arr[i]);
            }
        }
        
        // Reverse the array and trim the start again
        out = RG.SVG.arrayReverse(out);

        var out2 = [], content = false ;
        for (var i=0; i<out.length; i++) {
        
            if (out[i]) {
                content = true;
            }
        
            if (content) {
                out2.push(out[i]);
            }
        }
        
        // Now reverse the array and return it
        out2 = RG.SVG.arrayReverse(out2);

        return out2;
    };








    /**
    * Determines if the given object is an array or not
    * 
    * @param mixed obj The variable to test
    */
    RG.SVG.isArray = function (obj)
    {
        if (obj && obj.constructor) {
            var pos = obj.constructor.toString().indexOf('Array');
        } else {
            return false;
        }

        return obj != null &&
               typeof pos === 'number' &&
               pos > 0 &&
               pos < 20;
    };








    /**
    * Returns the absolute value of a number. You can also pass in an
    * array and it will run the abs() function on each element. It
    * operates recursively so sub-arrays are also traversed.
    * 
    * @param array arr The number or array to work on
    */
    RG.SVG.abs = function (value)
    {
        if (typeof value === 'string') {
            value = parseFloat(value) || 0;
        }

        if (typeof value === 'number') {
            return ma.abs(value);
        }

        if (typeof value === 'object') {
            for (i in value) {
                if (   typeof i === 'string'
                    || typeof i === 'number'
                    || typeof i === 'object') {

                    value[i] = RG.SVG.abs(value[i]);
                }
            }
            
            return value;
        }
        
        return 0;
    };








    //
    // Formats a number with thousand seperators so it's easier to read
    //
    // @param opt object The options to the function
    //
    RG.SVG.numberFormat = function (opt)
    {
        var obj                = opt.object,
            prepend            = opt.prepend ? String(opt.prepend) : '',
            append             = opt.append ? String(opt.append) : '',
            output             = '',
            decimal_seperator  = typeof opt.point === 'string' ? opt.point : '.',
            thousand_seperator = typeof opt.thousand === 'string' ? opt.thousand : ',',
            num                = opt.num;

        RegExp.$1   = '';

        if (typeof opt.formatter === 'function') {
            return opt.formatter(obj, num);
        }

        // Ignore the preformatted version of "1e-2"
        if (String(num).indexOf('e') > 0) {
            return String(prepend + String(num) + append);
        }

        // We need then number as a string
        num = String(num);
        
        // Take off the decimal part - we re-append it later
        if (num.indexOf('.') > 0) {
            var tmp = num;
            num     = num.replace(/\.(.*)/, ''); // The front part of the number
            decimal = tmp.replace(/(.*)\.(.*)/, '$2'); // The decimal part of the number
        } else {
            decimal = '';
        }

        // Thousand seperator
        //var seperator = arguments[1] ? String(arguments[1]) : ',';
        var seperator = thousand_seperator;
        
        /**
        * Work backwards adding the thousand seperators
        */
        var foundPoint;
        for (i=(num.length - 1),j=0; i>=0; j++,i--) {
            var character = num.charAt(i);
            
            if ( j % 3 == 0 && j != 0) {
                output += seperator;
            }
            
            /**
            * Build the output
            */
            output += character;
        }
        
        /**
        * Now need to reverse the string
        */
        var rev = output;
        output = '';
        for (i=(rev.length - 1); i>=0; i--) {
            output += rev.charAt(i);
        }

        // Tidy up
        //output = output.replace(/^-,/, '-');
        if (output.indexOf('-' + thousand_seperator) == 0) {
            output = '-' + output.substr(('-' + thousand_seperator).length);
        }

        // Reappend the decimal
        if (decimal.length) {
            output =  output + decimal_seperator + decimal;
            decimal = '';
            RegExp.$1 = '';
        }

        // Minor bugette
        if (output.charAt(0) == '-') {
            output = output.replace(/-/, '');
            prepend = '-' + prepend;
        }

        return prepend + output + append;
    };








    //
    // A function that adds text to the chart
    //
    RG.SVG.text = function (opt)
    {
        var obj        = opt.object,
            parent     = opt.parent,
            size       = opt.size,
            bold       = opt.bold,
            font       = opt.font,
            italic     = opt.italic,
            halign     = opt.halign,
            valign     = opt.valign,
            str        = opt.text,
            x          = opt.x,
            y          = opt.y,
            color      = opt.color ? opt.color : 'black',
            background = opt.background || null,
            padding    = opt.padding || 0;





        // Horizontal alignment
        if (halign === 'right') {
            halign = 'end';
        } else if (halign === 'center' || halign === 'middle') {
            halign = 'middle';
        } else {
            halign = 'start';
        }

        // Vertical alignment
        if (valign === 'top') {
            valign = 'hanging';
        } else if (valign === 'center' || valign === 'middle') {
            valign = 'central';
            valign = 'middle';
        } else {
            valign = 'bottom';
        }


        var text = RG.SVG.create({
            svg: obj.svg,
            parent: opt.parent || null,
            type: 'text',
            attr: {
                fill: color,
                x: x,
                y: y,
                'font-size': typeof size === 'number' ? size + 'pt' : size,
                'font-weight': bold ? 900 : 100,
                'font-family': font ? font : 'sans-serif',
                'font-style': italic ? 'italic' : 'normal',
                'text-anchor': halign,
                'dominant-baseline': valign
            }
        });

        var textNode = document.createTextNode(str);
        text.appendChild(textNode);



        //
        // Add a background color if specified
        //
        if (typeof background === 'string') {
        
            var bbox = text.getBBox(),
                rect = RG.SVG.create({
                svg: obj.svg,
                type: 'rect',
                attr: {
                    x:      bbox.x - padding,
                    y:      bbox.y - padding,
                    width:  bbox.width + (padding * 2),
                    height: bbox.height + (padding * 2),
                    fill:   background
                }
            });
            obj.svg.insertBefore(rect, text);
        }



        if (RG.SVG.ISIE && (valign === 'hanging') ) {
            text.setAttribute('y', y + (text.scrollHeight / 2));

        } else if (RG.SVG.ISIE && valign === 'middle') {
            text.setAttribute('y', y + (text.scrollHeight / 3));
        }




        if (RG.SVG.ISFF) {
            Y = y + (text.scrollHeight / 3);
        }
        
        return text;
    };








    //
    // Creates a UID that is applied to the object
    //
    RG.SVG.createUID = function ()
    {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c)
        {
            var r = ma.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
            return v.toString(16);
        });
    };








    //
    // Determines if the SVG DIV container is fixed
    //
    RG.SVG.isFixed = function (svg)
    {
        var obj = svg.parentNode,
            i   = 0;

        while (obj && obj.tagName.toLowerCase() != 'body' && i < 99) {

            if (obj.style.position === 'fixed') {
                return obj;
            }
            
            obj = obj.offsetParent;
        }

        return false;
    };








    /**
    * Sets an object in the RGraph registry
    * 
    * @param string name The name of the value to set
    */
    RG.SVG.REG.set = function (name, value)
    {
        RG.SVG.REG.store[name] = value;
        
        return value;
    };








    /**
    * Gets an object from the RGraph registry
    * 
    * @param string name The name of the value to fetch
    */
    RG.SVG.REG.get = function (name)
    {
        return RG.SVG.REG.store[name];
    };








    /**
    * Removes white-space from the start aqnd end of a string
    * 
    * @param string str The string to trim
    */
    RG.SVG.trim = function (str)
    {
        return RG.SVG.ltrim(RG.SVG.rtrim(str));
    };








    /**
    * Trims the white-space from the start of a string
    * 
    * @param string str The string to trim
    */
    RG.SVG.ltrim = function (str)
    {
        return str.replace(/^(\s|\0)+/, '');
    };








    /**
    * Trims the white-space off of the end of a string
    * 
    * @param string str The string to trim
    */
    RG.SVG.rtrim = function (str)
    {
        return str.replace(/(\s|\0)+$/, '');
    };








    //
    // Hides the currently shown tooltip
    //
    RG.SVG.hideTooltip = function ()
    {
        var tooltip = RG.SVG.REG.get('tooltip');
            //uid     = arguments[0] && arguments[0].uid ? arguments[0].uid : null;

        if (tooltip && tooltip.parentNode /*&& (!uid || uid == tooltip.__canvas__.uid)*/) {
            tooltip.parentNode.removeChild(tooltip);
            tooltip.style.display = 'none';                
            tooltip.style.visibility = 'hidden';
            RG.SVG.REG.set('tooltip', null);
        }
        
        if (tooltip && tooltip.__object__) {
            RG.SVG.removeHighlight(tooltip.__object__);
        }
    };








    //
    // Creates a shadow
    //
    RG.SVG.setShadow = function (options)
    {
        var obj     = options.object,
            offsetx = options.offsetx  || 0,
            offsety = options.offsety || 0,
            blur    = options.blur || 0,
            opacity = options.opacity || 0,
            id      = options.id;

        var filter = RG.SVG.create({
            svg: obj.svg,
            parent: obj.defs,
            type: 'filter',
            attr: {
                id: id,
                 width: "130%",
                 height: "130%"
            }
        });

        RG.SVG.create({
            svg: obj.svg,
            parent: filter,
            type: 'feOffset',
            attr: {
                result: 'offOut',
                'in': 'SourceGraphic',
                dx: offsetx,
                dy: offsety
            }
        });

        RG.SVG.create({
            svg: obj.svg,
            parent: filter,
            type: 'feColorMatrix',
            attr: {
                result: 'matrixOut',
                'in': 'offOut',
                type: 'matrix',
                values: '0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 {1} 0'.format(
                    opacity
                )
            }
        });

        RG.SVG.create({
            svg: obj.svg,
            parent: filter,
            type: 'feGaussianBlur',
            attr: {
                result: 'blurOut',
                'in': 'matrixOut',
                stdDeviation: blur
            }
        });

        RG.SVG.create({
            svg: obj.svg,
            parent: filter,
            type: 'feBlend',
            attr: {
                'in': 'SourceGraphic',
                'in2': 'blurOut',
                mode: 'normal'
            }
        });
    };








    /**
    * Takes a sequential index abd returns the group/index variation of it. Eg if you have a
    * sequential index from a grouped bar chart this function can be used to convert that into
    * an appropriate group/index combination
    * 
    * @param nindex number The sequential index
    * @param data   array  The original data (which is grouped)
    * @return              The group/index information
    */
    RG.SVG.sequentialIndexToGrouped = function (index, data)
    {
        var group         = 0,
            grouped_index = 0;

        while (--index >= 0) {

            if (RG.SVG.isNull(data[group])) {
                group++;
                grouped_index = 0;
                continue;
            }

            // Allow for numbers as well as arrays in the dataset
            if (typeof data[group] == 'number') {
                group++
                grouped_index = 0;
                continue;
            }
            

            grouped_index++;
            
            if (grouped_index >= data[group].length) {
                group++;
                grouped_index = 0;
            }
        }

        return [group, grouped_index];
    };








    //
    // This function converts coordinates into the type understood by
    // SVG for drawing arcs
    //
    RG.SVG.TRIG.toCartesian = function (options)
    {
        return {
            x: options.cx + (options.r * ma.cos(options.angle)),
            y: options.cy + (options.r * ma.sin(options.angle))
        };
    };








    //
    // Gets a path that is usable by the SVG A path command
    //
    // @patam object options The options/arg to the function
    //
    RG.SVG.TRIG.getArcPath = function (options)
    {
        //
        // Make circles start at the top instead of the right hand side
        //
        options.start -= 1.57;
        options.end   -= 1.57;

        var start = RG.SVG.TRIG.toCartesian({
            cx:    options.cx,
            cy:    options.cy,
            r:     options.r,
            angle: options.start}
        );

        var end = RG.SVG.TRIG.toCartesian({
            cx:    options.cx,
            cy:    options.cy,
            r:     options.r,
            angle: options.end
        });

        var diff = options.end - options.start;
        
        // Initial values
        var largeArc = '0';
        var sweep    = '0';

        if (options.anticlockwise && diff > 3.14) {
            largeArc = '0';
            sweep    = '0';
        } else if (options.anticlockwise && diff <= 3.14) {
            largeArc = '1';
            sweep    = '0';
        } else if (!options.anticlockwise && diff > 3.14) {
            largeArc = '1';
            sweep    = '1';
        } else if (!options.anticlockwise && diff <= 3.14) {
            largeArc = '0';
            sweep    = '1';
        }
        
        if (options.start > options.end && options.anticlockwise && diff <= 3.14) {
            largeArc = '0';
            sweep    = '0';
        }

        if (options.start > options.end && options.anticlockwise && diff > 3.14) {
            largeArc = '1';
            sweep    = '1';
        }


        if (typeof options.moveto === 'boolean' && options.moveto === false) {
            var d = [
                "A", options.r, options.r, 0, largeArc, sweep, end.x, end.y
            ];
        } else {
            var d = [
                "M", start.x, start.y, 
                "A", options.r, options.r, 0, largeArc, sweep, end.x, end.y
            ];
        }
        
        if (options.array === true) {
            return d;
        } else {
            return d.join(" ");
        }
    };








    //
    // Gets a path that is usable by the SVG A path command
    //
    // @patam object options The options/arg to the function
    //
    RG.SVG.TRIG.getArcPath2 = function (options)
    {
        //
        // Make circles start at the top instead of the right hand side
        //
        options.start -= 1.57;
        options.end   -= 1.57;

        var start = RG.SVG.TRIG.toCartesian({
            cx:    options.cx,
            cy:    options.cy,
            r:     options.r,
            angle: options.start
        });

        var end = RG.SVG.TRIG.toCartesian({
            cx:    options.cx,
            cy:    options.cy,
            r:     options.r,
            angle: options.end
        });

        var diff = ma.abs(options.end - options.start);
        
        // Initial values
        var largeArc = '0';
        var sweep    = '0';

        //TODO Put various options here for the correct combination of flags to use
        if (!options.anticlockwise) {
            if (diff > RG.SVG.TRIG.PI) {
                largeArc = '1';
                sweep    = '1';
            } else {
                largeArc = '0';
                sweep    = '1';
            }
        } else {
            if (diff > RG.SVG.TRIG.PI) {
                largeArc = '1';
                sweep    = '0';
            } else {
                largeArc = '0';
                sweep    = '0';
            }
        }

        if (typeof options.lineto === 'boolean' && options.lineto === false) {
            var d = [
                "M", start.x, start.y,
                "A", options.r, options.r, 0, largeArc, sweep, end.x, end.y
            ];
        } else {
            var d = [
                "M", options.cx, options.cy,
                "L", start.x, start.y, 
                "A", options.r, options.r, 0, largeArc, sweep, end.x, end.y
            ];
        }

        if (options.array === true) {
            return d;
        } else {
            return d.join(" ");
        }
    };








    /**
    * This function gets the end point (X/Y coordinates) of a given radius.
    * You pass it the center X/Y and the radius and this function will return
    * the endpoint X/Y coordinates.
    * 
    * @param number cx The center X coord
    * @param number cy The center Y coord
    * @param number r  The lrngth of the radius
    */
    RG.SVG.TRIG.getRadiusEndPoint = function (opt)
    {
        // Allow for two arguments style
        if (arguments.length === 1) {

            var angle = opt.angle,
                r     = opt.r;

        } else if (arguments.length === 4) {

            var angle = arguments[0],
                r     = arguments[1];
        }

        var x = ma.cos(angle) * r,
            y = ma.sin(angle) * r;

        return [x, y];
    };








    /**
    * This function draws the title. This function also draws the subtitle.
    */
    RG.SVG.drawTitle = function (obj)
    {
        var prop = obj.properties;
        
        //
        // The Pie chart title should default to being above the centerx
        //
        if (obj.type === 'pie') {
            if (RG.SVG.isNull(prop.titleX)) {
                prop.titleX         = obj.centerx;
                prop.titleSubtitleX = obj.centerx;
            }

            if (RG.SVG.isNull(prop.titleY)) {
                prop.titleY = obj.centery - obj.radius - 10;
            }
        }





        prop.titleY = typeof prop.titleY === 'number' ? prop.titleY : prop.gutterTop - 10;

        // If a subtitle is specified move the title up a bit in
        // order to accommodate it
        if (prop.titleSubtitle && typeof prop.titleSubtitleY !== 'number') {
            prop.titleY = prop.titleY - (prop.titleSubtitleSize * 1.5);
        }
        
        // Work out the subtitle size
        prop.titleSubTitleSize = prop.titleSubTitleSize || prop.textSize;
        
        // Work out the subtitle Y position
        prop.titleSubtitleY = prop.titleSubtitleY || prop.titleY + 8;






        // Draw the title
        if (prop.title) {

            RG.SVG.text({
                object: obj,
                svg:    obj.svg,
                text:   prop.title.toString(),
                size:   prop.titleSize   || (prop.textSize + 4) || 16,

                x:      typeof prop.titleX === 'number' ? prop.titleX : prop.gutterLeft + obj.graphWidth / 2,
                y:      prop.titleY,

                halign: prop.titleHalign || 'center',
                valign: prop.titleValign || 'bottom',
                color:  prop.titleColor  || prop.textColor || 'black',
                bold:   prop.titleBold   || false,
                italic: prop.titleItalic || false,
                font:   prop.titleFont   || prop.textFont || 'Arial'
            });
        }



        // Draw the subtitle
        if (prop.titleSubtitle) {
            RG.SVG.text({
                object: obj,
                svg: obj.svg,
                text:   prop.titleSubtitle,
                size:   prop.titleSubtitleSize,
                x:      typeof prop.titleSubtitleX === 'number' ? prop.titleSubtitleX : prop.gutterLeft + obj.graphWidth / 2,
                y:      prop.titleSubtitleY,
                halign: prop.titleSubtitleHalign || 'center',
                valign: prop.titleSubtitleValign || 'bottom',
                color:  prop.titleSubtitleColor  || prop.textColor || '#aaa',
                bold:   prop.titleSubtitleBold   || false,
                italic: prop.titleSubtitleItalic || false,
                font:   prop.titleSubtitleFont   || prop.textFont || 'Arial'
            });
        }
    };








    /**
    * Removes white-space from the start and end of a string
    * 
    * @param string str The string to trim
    */
    RG.SVG.trim = function (str)
    {
        return RG.SVG.ltrim(RG.SVG.rtrim(str));
    };








    /**
    * Trims the white-space from the start of a string
    * 
    * @param string str The string to trim
    */
    RG.SVG.ltrim = function (str)
    {
        return String(str).replace(/^(\s|\0)+/, '');
    };








    /**
    * Trims the white-space off of the end of a string
    * 
    * @param string str The string to trim
    */
    RG.SVG.rtrim = function (str)
    {
        return String(str).replace(/(\s|\0)+$/, '');
    };








    /**
    * This parses a single color value
    */
    RG.SVG.parseColorLinear = function (opt)
    {
        var obj   = opt.object,
            color = opt.color;

        if (!color || typeof color !== 'string') {
            return color;
        }

        if (color.match(/^gradient\((.*)\)$/i)) {
            
            var parts = RegExp.$1.split(':'),
                diff  = 1 / (parts.length - 1);

            if (opt && opt.direction && opt.direction === 'horizontal') {
                var grad = RG.SVG.create({
                    type: 'linearGradient',
                    parent: obj.defs,
                    attr: {
                        id: 'RGraph-linear-gradient' + obj.gradientCounter,
                        x1: opt.start || 0,
                        x2: opt.end || '100%',
                        y1: 0,
                        y2: 0,
                        gradientUnits: "userSpaceOnUse"
                    }
                });

            } else {

                var grad = RG.SVG.create({
                    type: 'linearGradient',
                    parent: obj.defs,
                    attr: {
                        id: 'RGraph-linear-gradient' + obj.gradientCounter,
                        x1: 0,
                        x2: 0,
                        y1: opt.start || 0,
                        y2: opt.end || '100%',
                        gradientUnits: "userSpaceOnUse"
                    }
                });
            }

            // Add the first color stop
            var stop = RG.SVG.create({
                type: 'stop',
                parent: grad,
                attr: {
                    offset: '0%',
                    'stop-color': RG.SVG.trim(parts[0])
                }
            });

            // Add the rest of the color stops
            for (var j=1,len=parts.length; j<len; ++j) {
                
                RG.SVG.create({
                    type: 'stop',
                    parent: grad,
                    attr: {
                        offset: (j * diff * 100) + '%',
                        'stop-color': RG.SVG.trim(parts[j])
                    }
                });
            }
        }
        
        color = grad ? 'url(#RGraph-linear-gradient' + (obj.gradientCounter++) + ')' : color;

        return color;
    };








    /**
    * This parses a single color value
    */
    RG.SVG.parseColorRadial = function (opt)
    {
        var obj   = opt.object,
            color = opt.color;

        if (!color || typeof color !== 'string') {
            return color;
        }

        if (color.match(/^gradient\((.*)\)$/i)) {

            var parts = RegExp.$1.split(':'),
                diff  = 1 / (parts.length - 1);


            var grad = RG.SVG.create({
                type: 'radialGradient',
                parent: obj.defs,
                attr: {
                    id: 'RGraph-radial-gradient' + obj.gradientCounter,
                    gradientUnits: 'userSpaceOnUse',
                    cx: obj.centerx,
                    cy: obj.centery,
                    fx: obj.centerx,
                    fy: obj.centery,
                    r: obj.radius
                }
            });

            // Add the first color stop
            var stop = RG.SVG.create({
                type: 'stop',
                parent: grad,
                attr: {
                    offset: '0%',
                    'stop-color': RG.SVG.trim(parts[0])
                }
            });

            // Add the rest of the color stops
            for (var j=1,len=parts.length; j<len; ++j) {
                
                RG.SVG.create({
                    type: 'stop',
                    parent: grad,
                    attr: {
                        offset: (j * diff * 100) + '%',
                        'stop-color': RG.SVG.trim(parts[j])
                    }
                });
            }
        }
        
        color = grad ? 'url(#RGraph-radial-gradient' + (obj.gradientCounter++) + ')' : color;

        return color;
    };








    /**
    * Reset all of the color values to their original values
    * 
    * @param object
    */
    RG.SVG.resetColorsToOriginalValues = function (opt)
    {
        var obj = opt.object;

        if (obj.originalColors) {
            // Reset the colors to their original values
            for (var j in obj.originalColors) {
                if (typeof j === 'string') {
                    obj.properties[j] = RG.SVG.arrayClone(obj.originalColors[j]);
                }
            }
        }

        /**
        * If the function is present on the object to reset specific
        * colors - use that
        */
        if (typeof obj.resetColorsToOriginalValues === 'function') {
            obj.resetColorsToOriginalValues();
        }

        // Hmmm... Should this be necessary?
        obj.originalColors = {};



        // Reset the colorsParsed flag so that they're parsed for gradients again
        obj.colorsParsed = false;
        
        // Reset the gradient counter
        obj.gradientCounter = 1;
    };








    //
    // Clear the SVG tag by deleting all of its
    // child nodes
    //
    // @param object svg The SVG tag (same as what is returned
    //                   by document.getElementById() )
    //
    RG.SVG.clear = function (svg)
    {
        while (svg.lastChild) {
            svg.removeChild(svg.lastChild);
        }
    };








    /**
    * Adds an event listener
    * 
    * @param object obj   The graph object
    * @param string event The name of the event, eg ontooltip
    * @param object func  The callback function
    */
    RG.SVG.addCustomEventListener = function (obj, name, func)
    {
        // Initialise the events array if necessary
        if (typeof RG.SVG.events[obj.uid] === 'undefined') {
            RG.SVG.events[obj.uid] = [];
        }
        
        // Prepend "on" if necessary
        if (name.substr(0, 2) !== 'on') {
            name = 'on' + name;
        }

        RG.SVG.events[obj.uid].push({
            object: obj,
            event:  name,
            func:   func
        });

        return RG.SVG.events[obj.uid].length - 1;
    };








    /**
    * Used to fire one of the RGraph custom events
    * 
    * @param object obj   The graph object that fires the event
    * @param string event The name of the event to fire
    */
    RG.SVG.fireCustomEvent = function (obj, name)
    {
        if (obj && obj.isRGraph) {
            
            var uid = obj.uid;

            if (   typeof uid === 'string'
                && typeof RG.SVG.events === 'object'
                && typeof RG.SVG.events[uid] === 'object'
                && RG.SVG.events[uid].length > 0) {

                for(var j=0,len=RG.SVG.events[uid].length; j<len; ++j) {
                    if (RG.SVG.events[uid][j] && RG.SVG.events[uid][j].event === name) {
                        RG.SVG.events[uid][j].func(obj);
                    }
                }
            }
        }
    };








    /**
    * Clears all the custom event listeners that have been registered
    * 
    * @param string optional Limits the clearing to this object UID
    */
    RG.SVG.removeAllCustomEventListeners = function ()
    {
        var uid = arguments[0];

        if (uid && RG.SVG.events[uid]) {
            RG.SVG.events[uid] = {};
        } else {
            RG.SVG.events = [];
        }
    };








    /**
    * Clears a particular custom event listener
    * 
    * @param object obj The graph object
    * @param number i   This is the index that is return by .addCustomEventListener()
    */
    RG.SVG.removeCustomEventListener = function (obj, i)
    {
        if (   typeof RG.SVG.events === 'object'
            && typeof RG.SVG.events[obj.uid] === 'object'
            && typeof RG.SVG.events[obj.uid][i] === 'object') {
            
            RG.SVG.events[obj.uid][i] = null;
        }
    };








    //
    // Removes the highlight from the chart added by tooltips (possibly others too)
    //
    RG.SVG.removeHighlight = function (obj)
    {
        var highlight = RG.SVG.REG.get('highlight');

        if (highlight && RG.SVG.isArray(highlight) && highlight.length) {
            for (var i=0,len=highlight.length; i<len; ++i) {
                if (highlight[i].parentNode) {
                    obj.svg.removeChild(highlight[i]);
                }
            }
        } else if (highlight && highlight.parentNode) {
            highlight.parentNode.removeChild(highlight);
        }
    };








    //
    // Removes the highlight from the chart added by tooltips (possibly others too)
    //
    RG.SVG.redraw = function ()
    {
        if (arguments.length === 1) {
            
            var svg = arguments[0];
            
            RG.SVG.clear(svg);
    
            var objects = RG.SVG.OR.get('id:' + svg.parentNode.id);

            for (var i=0,len=objects.length; i<len; ++i) {

                // Reset the colors to the original values
                RG.SVG.resetColorsToOriginalValues({object: objects[i]});


                objects[i].draw();
            }
        } else {
        
            var tags = RG.SVG.OR.tags();
            
            for (var i in tags) {
                RG.SVG.redraw(tags[i]);
            }
        }
    };








    /**
    * This is the same as Date.parse - though a little more flexible and accepts
    * a few more formats.
    * 
    * @param string str The date string to parse
    * @return Returns the same thing as Date.parse
    */
    RG.SVG.parseDate = function (str)
    {
        str = RG.SVG.trim(str);

        // Allow for: now (just the word "now")
        if (str === 'now') {
            str = (new Date()).toString();
        }


        // Allow for: 22-11-2013
        // Allow for: 22/11/2013
        // Allow for: 22-11-2013 12:09:09
        // Allow for: 22/11/2013 12:09:09
        if (str.match(/^(\d\d)(?:-|\/)(\d\d)(?:-|\/)(\d\d\d\d)(.*)$/)) {
            str = '{1}/{2}/{3}{4}'.format(
                RegExp.$3,
                RegExp.$2,
                RegExp.$1,
                RegExp.$4
            );
        }

        // Allow for: 2013-11-22 12:12:12 or  2013/11/22 12:12:12
        if (str.match(/^(\d\d\d\d)(-|\/)(\d\d)(-|\/)(\d\d)( |T)(\d\d):(\d\d):(\d\d)$/)) {
            str = RegExp.$1 + '-' + RegExp.$3 + '-' + RegExp.$5 + 'T' + RegExp.$7 + ':' + RegExp.$8 + ':' + RegExp.$9;
        }

        // Allow for: 2013-11-22
        if (str.match(/^\d\d\d\d-\d\d-\d\d$/)) {
            str = str.replace(/-/g, '/');
        }


        // Allow for: 12:09:44 (time only using todays date)
        if (str.match(/^\d\d:\d\d:\d\d$/)) {
        
            var dateObj  = new Date();
            var date     = dateObj.getDate();
            var month    = dateObj.getMonth() + 1;
            var year     = dateObj.getFullYear();
            
            // Pad the date/month with a zero if it's not two characters
            if (String(month).length === 1) month = '0' + month;
            if (String(date).length === 1) date = '0' + date;

            str = (year + '/' + month + '/' + date) + ' ' + str;
        }

        return Date.parse(str);
    };








    // The ObjectRegistry add function
    RG.SVG.OR.add = function (obj)
    {
        RG.SVG.OR.objects.push(obj);

        return obj;
    };








    // The ObjectRegistry function that returns all of the objects. Th argument
    // can aither be:
    //
    // o omitted  All of the registered objects are returned
    // o id:XXX  All of the objects on that SVG tag are returned
    // o type:XXX All the objects of that type are returned
    //
    RG.SVG.OR.get = function ()
    {
        // Fetch objects that are on a particular SVG tag
        if (typeof arguments[0] === 'string' && arguments[0].substr(0, 3).toLowerCase() === 'id:') {
            
            var ret = [];

            for (var i=0; i<RG.SVG.OR.objects.length; ++i) {
                if (RG.SVG.OR.objects[i].id === arguments[0].substr(3)) {
                    ret.push(RG.SVG.OR.objects[i]);
                }
            }

            return ret;
        }


        // Fetch objects that are of a particular type
        //
        // TODO Allow multiple types to be specified
        if (typeof arguments[0] === 'string' && arguments[0].substr(0, 4).toLowerCase() === 'type') {
            
            var ret = [];
            
            for (var i=0; i<RG.SVG.OR.objects.length; ++i) {
                if (RG.SVG.OR.objects[i].type === arguments[0].substr(5)) {
                    ret.push(RG.SVG.OR.objects[i]);
                }
            }
            
            return ret;
        }


        // Fetch an object that has a specific UID
        if (typeof arguments[0] === 'string' && arguments[0].substr(0, 3).toLowerCase() === 'uid') {
            
            var ret = [];
            
            for (var i=0; i<RG.SVG.OR.objects.length; ++i) {
                if (RG.SVG.OR.objects[i].uid === arguments[0].substr(4)) {
                    ret.push(RG.SVG.OR.objects[i]);
                }
            }
            
            return ret;
        }

        return RG.SVG.OR.objects;
    };








    // The ObjectRegistry function that returns all of the registeredt SVG tags
    //
    RG.SVG.OR.tags = function ()
    {
        var tags = [];

        for (var i=0; i<RG.SVG.OR.objects.length; ++i) {
            if (!tags[RG.SVG.OR.objects[i].svg.parentNode.id]) {
                tags[RG.SVG.OR.objects[i].svg.parentNode.id] = RG.SVG.OR.objects[i].svg;
            }
        }

        return tags;
    };








    //
    // This function returns a two element array of the SVG x/y position in
    // relation to the page
    // 
    // @param object svg
    //
    RG.SVG.getSVGXY = function (svg)
    {
        var x  = 0,
            y  = 0,
            el = svg.parentNode; // !!!

        do {

            x += el.offsetLeft;
            y += el.offsetTop;

            // Account for tables in webkit
            if (el.tagName.toLowerCase() == 'table' && (RG.SVG.ISCHROME || RG.SVG.ISSAFARI)) {
                x += parseInt(el.border) || 0;
                y += parseInt(el.border) || 0;
            }

            el = el.offsetParent;

        } while (el && el.tagName && el.tagName.toLowerCase() != 'body');


        var paddingLeft = svg.style.paddingLeft ? parseInt(svg.style.paddingLeft) : 0,
            paddingTop  = svg.style.paddingTop ? parseInt(svg.style.paddingTop) : 0,
            borderLeft  = svg.style.borderLeftWidth ? parseInt(svg.style.borderLeftWidth) : 0,
            borderTop   = svg.style.borderTopWidth  ? parseInt(svg.style.borderTopWidth) : 0;

        if (navigator.userAgent.indexOf('Firefox') > 0) {
            x += parseInt(document.body.style.borderLeftWidth) || 0;
            y += parseInt(document.body.style.borderTopWidth) || 0;
        }

        return [x + paddingLeft + borderLeft, y + paddingTop + borderTop];
    };




    /**
    * This function determines whther a canvas is fixed (CSS positioning) or not. If not it returns
    * false. If it is then the element that is fixed is returned (it may be a parent of the canvas).
    * 
    * @return Either false or the fixed positioned element
    */
    RG.isFixed = function (canvas)
    {
        var obj = canvas;
        var i = 0;

        while (obj && obj.tagName.toLowerCase() != 'body' && i < 99) {

            if (obj.style.position == 'fixed') {
                return obj;
            }
            
            obj = obj.offsetParent;
        }

        return false;
    };








    //
    // This function is a compatibility wrapper around
    // the requestAnimationFrame function.
    //
    // @param function func The function to give to the
    //                      requestAnimationFrame function
    //
    RG.SVG.FX.update = function (func)
    {
        win.requestAnimationFrame =
            win.requestAnimationFrame ||
            win.webkitRequestAnimationFrame ||
            win.msRequestAnimationFrame ||
            win.mozRequestAnimationFrame ||
            (function (func){setTimeout(func, 16.666);});
        
        win.requestAnimationFrame(func);
    };








    /**
    * This function returns an easing multiplier for effects so they eas out towards the
    * end of the effect.
    * 
    * @param number frames The total number of frames
    * @param number frame  The frame number
    */
    RG.SVG.FX.getEasingMultiplier = function (frames, frame)
    {
        var multiplier = ma.pow(ma.sin((frame / frames) * RG.SVG.TRIG.HALFPI), 3);

        return multiplier;
    };








    /**
    * Measures text by creating a DIV in the document and adding the relevant
    * text to it, then checking the .offsetWidth and .offsetHeight.
    * 
    * @param  object opt An object containing the following:
    *                        o text( string) The text to measure
    *                        o bold (bool)   Whether the text is bold or not
    *                        o font (string) The font to use
    *                        o size (number) The size of the text (in pts)
    * 
    * @return array         A two element array of the width and height of the text
    */
    RG.SVG.measureText = function (opt)
    {
        //text, bold, font, size
        var text = opt.text || '',
            bold = opt.bold || false,
            font = opt.font || 'Arial',
            size = opt.size || 10,
            str  = text + ':' + bold + ':' + font + ':' + size;

        // Add the sizes to the cache as adding DOM elements is costly and causes slow downs
        if (typeof RG.SVG.measuretext_cache === 'undefined') {
            RG.SVG.measuretext_cache = [];
        }

        if (typeof RG.SVG.measuretext_cache == 'object' && RG.SVG.measuretext_cache[str]) {
            return RG.SVG.measuretext_cache[str];
        }
        
        if (!RG.SVG.measuretext_cache['text-div']) {
            var div = document.createElement('DIV');
                div.style.position = 'absolute';
                div.style.top      = '-100px';
                div.style.left     = '-100px';
            document.body.appendChild(div);
            
            // Now store the newly created DIV
            RG.SVG.measuretext_cache['text-div'] = div;

        } else if (RG.SVG.measuretext_cache['text-div']) {
            var div = RG.SVG.measuretext_cache['text-div'];
        }

        div.innerHTML        = text.replace(/\r\n/g, '<br />');
        div.style.fontFamily = font;
        div.style.fontWeight = bold ? 'bold' : 'normal';
        div.style.fontSize   = size + 'pt';
        
        var sizes = [div.offsetWidth, div.offsetHeight];

        //document.body.removeChild(div);
        RG.SVG.measuretext_cache[str] = sizes;
        
        return sizes;
    };








    /**
    * This function converts an array of strings to an array of numbers. Its used by the meter/gauge
    * style charts so that if you want you can pass in a string. It supports various formats:
    * 
    * '45.2'
    * '-45.2'
    * ['45.2']
    * ['-45.2']
    * '45.2,45.2,45.2' // A CSV style string
    * 
    * @param number frames The string or array to parse
    */
    RG.SVG.stringsToNumbers = function (str)
    {
        // An optional seperator to use intead of a comma
        var sep = arguments[1] || ',';
        
        
        // If it's already a number just return it
        if (typeof str === 'number') {
            return str;
        }





        if (typeof str === 'string') {
            if (str.indexOf(sep) != -1) {
                str = str.split(sep);
            } else {
                str = parseFloat(str);
            }
        }





        if (typeof str === 'object') {
            for (var i=0,len=str.length; i<len; i+=1) {
                str[i] = parseFloat(str[i]);
            }
        }

        return str;
    };








    // This function allows for numbers that are given as a +/- adjustment
    RG.SVG.getAdjustedNumber = function (opt)
    {
        var value = opt.value,
            prop  = opt.prop;
    
        if (typeof prop === 'string' && match(/^(\+|-)([0-9.]+)/)) {
            if (RegExp.$1 === '+') {
                value += parseFloat(RegExp.$2);
            } else if (RegExp.$1 === '-') {
                value -= parseFloat(RegExp.$2);
            }
        }
        
        return value;
    };








    //
    // Adds the attribution link to the chart in the
    // (by default) bottom right corner
    //
    //@param ibject obj The chart object
    //
    RG.SVG.attribution = function (obj)
    {
        var prop = obj.properties;

        if (!prop.attribution && typeof prop.attribution !== 'undefined') {
            return false;
        }


        // Create the A tag
        var a = RG.SVG.create({
            svg: obj.svg,
            type: 'a',
            attr: {
                'xlink:href': prop.attributionHref || 'http://www.rgraph.net'
            }
        });



        // Work out the X/Y coords
        var x = parseFloat(obj.svg.getAttribute('width')) - 2,
            y = parseFloat(obj.svg.getAttribute('height')) - 2;
        
        // Allow the X coord to be a +/- string
        if (typeof prop.attributionX === 'string') {
            x += parseFloat(prop.attributionX);
        } else if (typeof prop.attributionX === 'number') {
            x = parseFloat(prop.attributionX);
        }
        
        // Allow the Y coord to be a +/- string|
        if (typeof prop.attributionY === 'string') {
            y += parseFloat(prop.attributionY);
        } else if (typeof prop.attributionY === 'number') {
            y = parseFloat(prop.attributionY);
        }

        // Add a text tag to the attribution A tag
        var text = RG.SVG.text({
            object: obj,
            parent: a,
            text:   typeof prop.attributionText === 'string' ? prop.attributionText : 'RGraph.net',
            x:      x,
            y:      y,
            halign: prop.attributionHalign || 'right',
            valign: prop.attributionValign || 'bottom',
            font:   prop.attributionFont   || 'sans-serif',
            size:   prop.attributionSize   || 7,
            color:  prop.attributionColor  || 'gray',
            italic: prop.attributionItalic,
            bold:   prop.attributionBold
        });
    };








    /**
    * Generates a random number between the minimum and maximum
    * 
    * @param number min The minimum value
    * @param number max The maximum value
    * @param number     OPTIONAL Number of decimal places
    */
    RG.SVG.random = function (min, max)
    {
        var dp = arguments[2] ? arguments[2] : 0;
        var r  = ma.random();
        
        return Number((((max - min) * r) + min).toFixed(dp));
    };








    //
    // This is here so that if the tooltip library has not
    // been included, this function will show an alert
    //informing the user
    //
    if (typeof RG.SVG.tooltip !== 'function') {
        RG.SVG.tooltip = function ()
        {
            $a('The tooltip library has not been included!');
        };
    }








// End module pattern
})(window, document);




    /**
    * Loosly mimicks the PHP function print_r();
    */
    window.$p = function (obj)
    {
        var indent = (arguments[2] ? arguments[2] : '    ');
        var str    = '';

        var counter = typeof arguments[3] == 'number' ? arguments[3] : 0;
        
        if (counter >= 5) {
            return '';
        }
        
        switch (typeof obj) {
            
            case 'string':    str += obj + ' (' + (typeof obj) + ', ' + obj.length + ')'; break;
            case 'number':    str += obj + ' (' + (typeof obj) + ')'; break;
            case 'boolean':   str += obj + ' (' + (typeof obj) + ')'; break;
            case 'function':  str += 'function () {}'; break;
            case 'undefined': str += 'undefined'; break;
            case 'null':      str += 'null'; break;
            
            case 'object':
                // In case of null
                if (RGraph.SVG.isNull(obj)) {
                    str += indent + 'null\n';
                } else {
                    str += indent + 'Object {' + '\n'
                    for (j in obj) {
                        str += indent + '    ' + j + ' => ' + window.$p(obj[j], true, indent + '    ', counter + 1) + '\n';
                    }
                    str += indent + '}';
                }
                break;
            
            
            default:
                str += 'Unknown type: ' + typeof obj + '';
                break;
        }


        /**
        * Finished, now either return if we're in a recursed call, or alert()
        * if we're not.
        */
        if (!arguments[1]) {
            alert(str);
        }
        
        return str;
    };



    /**
    * A shorthand for the default alert() function
    */
    window.$a = function (v)
    {
        alert(v);
    };




    /**
    * Short-hand for console.log
    * 
    * @param mixed v The variable to log to the console
    */
    window.$cl = function (v)
    {
        return console.log(v);
    };




    /**
    * A basic string formatting function. Use it like this:
    * 
    * var str = '{0} {1} {2}'.format('a', 'b', 'c');
    * 
    * Outputs: a b c
    */
    if (!String.prototype.format) {
      String.prototype.format = function()
      {
        var args = arguments;

        return this.replace(/{(\d+)}/g, function(str, idx)
        {
          return typeof args[idx - 1] !== 'undefined' ? args[idx - 1] : str;
        });
      };
    }