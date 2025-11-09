import React, { useEffect, useRef } from 'react';
import * as d3 from 'd3';
import * as topojson from 'topojson-client';

export default function IndiaChoropleth({ width = 800, height = 600 }) {
  const svgRef = useRef();
  const tooltipRef = useRef();

  useEffect(() => {
    // Clear previous map
    d3.select(svgRef.current).selectAll("*").remove();

    // Set up the SVG
    const svg = d3.select(svgRef.current)
      .attr("width", "100%")
      .attr("height", height)
      .attr("viewBox", [0, 0, width, height])
      .attr("style", "max-width: 100%; height: auto; display: block;");

    // Create a group for the map
    const g = svg.append("g");

    // Tooltip setup
    const tooltip = d3.select(tooltipRef.current)
      .style("position", "absolute")
      .style("visibility", "hidden")
      .style("background", "white")
      .style("padding", "8px")
      .style("border-radius", "4px")
      .style("box-shadow", "0 2px 4px rgba(0,0,0,0.2)")
      .style("font-size", "14px");

    // Color scale for the choropleth
    const colorScale = d3.scaleSequential()
      .domain([0, 100]) // Adjust domain based on your data
      .interpolator(d3.interpolateBlues);

    // Load and draw the India TopoJSON
    d3.json("https://cdn.jsdelivr.net/npm/india-atlas@2.0.0/states/indian_states_2020.json")
      .then(indiaTopo => {
        // Convert TopoJSON to GeoJSON
        const states = topojson.feature(indiaTopo, indiaTopo.objects.indian_states_2020);

        // Create a projection
        const projection = d3.geoMercator()
          .fitSize([width, height], states);

        // Create a path generator
        const path = d3.geoPath().projection(projection);

        // Draw states
        g.selectAll("path")
          .data(states.features)
          .enter()
          .append("path")
          .attr("d", path)
          .attr("fill", d => colorScale(Math.random() * 100)) // Replace with your data
          .attr("stroke", "#fff")
          .attr("stroke-width", 0.5)
          .on("mouseover", function(event, d) {
            d3.select(this).attr("opacity", 0.8);
            tooltip
              .style("visibility", "visible")
              .html(`<strong>${d.properties.st_nm}</strong>`);
          })
          .on("mousemove", function(event) {
            tooltip
              .style("top", (event.pageY - 10) + "px")
              .style("left", (event.pageX + 10) + "px");
          })
          .on("mouseout", function() {
            d3.select(this).attr("opacity", 1);
            tooltip.style("visibility", "hidden");
          })
          .on("click", function(event, d) {
            // Handle state click
            console.log("Clicked:", d.properties.st_nm);
            // You can add navigation or other interactions here
          });

        // Add zoom functionality
        svg.call(d3.zoom()
          .scaleExtent([1, 8])
          .on("zoom", (event) => {
            g.attr("transform", event.transform);
          }));
      })
      .catch(error => {
        console.error("Error loading the map data:", error);
      });
  }, [width, height]);

  return (
    <div style={{ position: 'relative' }}>
      <svg ref={svgRef} width={width} height={height}></svg>
      <div ref={tooltipRef} className="map-tooltip"></div>
    </div>
  );
}
