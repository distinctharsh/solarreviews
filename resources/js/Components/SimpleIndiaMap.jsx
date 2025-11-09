import React, { useState, useEffect } from 'react';
import { MapContainer, TileLayer, GeoJSON } from 'react-leaflet';
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';

// Fix for default marker icons
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
  iconRetinaUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon-2x.png',
  iconUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png',
  shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
});

const SimpleIndiaMap = () => {
  const [geoData, setGeoData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // India bounds
  const indiaBounds = [
    [6.0, 68.0],   // Southwest coordinates
    [36.0, 98.0]   // Northeast coordinates
  ];

  useEffect(() => {
    // Load GeoJSON data
    const loadGeoData = async () => {
      try {
        console.log('Starting to load map data...');
        setLoading(true);
        
        // Test URL accessibility
        const testUrl = 'https://raw.githubusercontent.com/geohacker/india/master/state/india_state.geojson';
        console.log('Fetching data from:', testUrl);
        
        const response = await fetch(testUrl);
        console.log('Response status:', response.status);
        
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Successfully loaded GeoJSON data');
        console.log('Features count:', data.features ? data.features.length : 'none');
        
        setGeoData(data);
      } catch (err) {
        console.error('Error loading map data:', err);
        setError(`Failed to load map: ${err.message}. Please check your internet connection.`);
      } finally {
        setLoading(false);
      }
    };

    loadGeoData();
  }, []);

  // Style for the states
  const stateStyle = () => ({
    fillColor: '#3b82f6',
    weight: 1,
    opacity: 1,
    color: 'white',
    fillOpacity: 0.7,
  });

  // Highlight state on hover
  const highlightFeature = (e) => {
    const layer = e.target;
    layer.setStyle({
      weight: 2,
      color: '#666',
      fillOpacity: 0.9
    });
  };

  // Reset style on mouseout
  const resetHighlight = (e) => {
    const layer = e.target;
    layer.setStyle(stateStyle());
  };

  // Handle state click
  const onEachFeature = (feature, layer) => {
    layer.on({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
      click: (e) => {
        const stateName = feature.properties.NAME_1 || 'Unknown State';
        console.log('Clicked on:', stateName);
      }
    });
  };

  // Debug info
  console.log('Render - Loading:', loading, 'Error:', error, 'Has GeoData:', !!geoData);
  
  if (loading) {
    return (
      <div style={{
        height: '600px',
        display: 'flex',
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: '#f8f9fa',
        borderRadius: '12px'
      }}>
        <div style={{ textAlign: 'center' }}>
          <div style={{
            width: '50px',
            height: '50px',
            border: '4px solid #e2e8f0',
            borderTopColor: '#3b82f6',
            borderRadius: '50%',
            animation: 'spin 1s linear infinite',
            margin: '0 auto 1rem'
          }}></div>
          <p style={{ color: '#4b5563', fontWeight: 500 }}>Loading map...</p>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div style={{
        height: '600px',
        display: 'flex',
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: '#f8f9fa',
        borderRadius: '12px',
        color: '#ef4444',
        padding: '20px',
        textAlign: 'center'
      }}>
        {error}
      </div>
    );
  }

  // Check if we have valid geo data
  const hasValidGeoData = geoData && Array.isArray(geoData.features) && geoData.features.length > 0;
  
  return (
    <div style={{ width: '100%', height: '600px', borderRadius: '12px', overflow: 'hidden', position: 'relative' }}>
      <div style={{ 
        position: 'absolute', 
        top: '10px', 
        left: '10px', 
        zIndex: 1000, 
        background: 'rgba(255, 255, 255, 0.9)', 
        padding: '5px 10px', 
        borderRadius: '4px',
        fontSize: '12px',
        border: '1px solid #ddd'
      }}>
        Map Status: {loading ? 'Loading...' : hasValidGeoData ? 'Ready' : 'No Data'}
      </div>
      
      <MapContainer
        center={[20.5937, 78.9629]} // Center of India
        zoom={5}
        style={{ 
          height: '100%', 
          width: '100%',
          backgroundColor: '#f8f9fa'
        }}
        minZoom={4}
        maxBounds={indiaBounds}
        maxBoundsViscosity={1.0}
        scrollWheelZoom={true}
        whenReady={() => console.log('Map is ready')}
      >
        <TileLayer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        />
        
        {geoData && (
          <GeoJSON
            data={geoData}
            style={stateStyle}
            onEachFeature={onEachFeature}
          />
        )}
      </MapContainer>
    </div>
  );
};

export default SimpleIndiaMap;
