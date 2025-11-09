import React, { useState, useEffect, useRef } from 'react';
import {
  ComposableMap,
  Geographies,
  Geography,
  ZoomableGroup,
  Marker
} from "react-simple-maps";

// India GeoJSON data
const geoUrl = "https://raw.githubusercontent.com/geohacker/india/master/state/india_state.geojson";

const InteractiveIndiaMap = () => {
  const [selectedState, setSelectedState] = useState(null);
  const [providers, setProviders] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [mapReady, setMapReady] = useState(false);
  const [position, setPosition] = useState({ coordinates: [78.9629, 22.5], zoom: 4 });
  const mapContainerRef = useRef(null);

  // Hide loading indicator when component mounts
  useEffect(() => {
    const timer = setTimeout(() => {
      setIsLoading(false);
      setMapReady(true);
    }, 1000);
    return () => clearTimeout(timer);
  }, []);

  // Mock data for solar providers
  const getSolarProvidersByState = (stateName) => {
    const providersData = {
      'maharashtra': [
        { id: 1, name: 'SunPower India', rating: 4.5, reviews: 128, location: 'Mumbai' },
        { id: 2, name: 'Tata Power Solar', rating: 4.2, reviews: 98, location: 'Pune' },
        { id: 3, name: 'Adani Solar', rating: 4.0, reviews: 85, location: 'Nashik' }
      ],
      'karnataka': [
        { id: 4, name: 'Renew Power', rating: 4.3, reviews: 112, location: 'Bangalore' },
        { id: 5, name: 'Hero Solar', rating: 4.1, reviews: 76, location: 'Mysore' }
      ],
      'gujarat': [
        { id: 6, name: 'Gujarat Solar', rating: 4.4, reviews: 92, location: 'Ahmedabad' },
        { id: 7, name: 'Surya Power', rating: 4.0, reviews: 68, location: 'Surat' }
      ],
      'tamil-nadu': [
        { id: 8, name: 'Tamil Nadu Solar', rating: 4.2, reviews: 88, location: 'Chennai' },
        { id: 9, name: 'Green Power', rating: 4.3, reviews: 77, location: 'Coimbatore' }
      ],
      'rajasthan': [
        { id: 10, name: 'Rajasthan Solar', rating: 4.5, reviews: 95, location: 'Jaipur' },
        { id: 11, name: 'Desert Power', rating: 4.0, reviews: 82, location: 'Jodhpur' }
      ]
    };
    return providersData[stateName] || [];
  };

  const handleStateClick = (geo) => {
    if (!geo || !geo.properties || !geo.properties.NAME_1) return;
    
    const stateName = geo.properties.NAME_1.toLowerCase().replace(/\s+/g, '-');
    setSelectedState(geo.properties.NAME_1);
    setProviders(getSolarProvidersByState(stateName));
    
    // Get the center coordinates of the state
    const [centroidLng, centroidLat] = geo.properties.centroid || [78.9629, 22.5];
    
    // Center the map on the selected state with a smooth transition
    setPosition(prev => ({
      coordinates: [centroidLng, centroidLat],
      zoom: 5
    }));
    
    // Scroll to the providers section if on mobile
    if (window.innerWidth < 768) {
      const providersSection = document.getElementById('providers-section');
      if (providersSection) {
        providersSection.scrollIntoView({ behavior: 'smooth' });
      }
    }
  };

  // Calculate the center of India for the initial view
  const center = [78.9629, 22.5];
  
  return (
    <div style={{ width: '100%', maxWidth: '1200px', margin: '0 auto' }}>
      <div 
        ref={mapContainerRef}
        style={{ 
          width: '100%', 
          height: '600px',
          position: 'relative',
          borderRadius: '12px',
          overflow: 'hidden',
          boxShadow: '0 4px 6px rgba(0,0,0,0.1)',
          backgroundColor: '#f8f9fa',
          border: '1px solid #e2e8f0',
          marginBottom: '20px',
          opacity: mapReady ? 1 : 0.7,
          transition: 'opacity 0.3s ease'
        }}
      >
        {isLoading && (
          <div style={{
            position: 'absolute',
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            display: 'flex',
            justifyContent: 'center',
            alignItems: 'center',
            backgroundColor: 'rgba(255, 255, 255, 0.9)',
            zIndex: 10
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
        )}
        <ComposableMap
          projection="geoMercator"
          projectionConfig={{
            scale: 1000,
            center: center,
            precision: 0.001
          }}
          width={1200}
          height={600}
          style={{
            width: '100%',
            height: '100%',
            backgroundColor: '#f8f9fa'
          }}
        >
          <ZoomableGroup
            center={position.coordinates}
            zoom={position.zoom}
            minZoom={3}
            maxZoom={8}
            onMoveEnd={({ coordinates, zoom }) => {
              setPosition({ coordinates, zoom });
            }}
          >
            <Geographies geography={geoUrl}>
              {({ geographies }) =>
                geographies.map((geo) => {
                  const isSelected = selectedState === geo.properties.NAME_1;
                  return (
                    <Geography
                      key={geo.rsmKey}
                      geography={geo}
                      onClick={() => handleStateClick(geo)}
                      style={{
                        default: {
                          fill: isSelected ? '#1d4ed8' : '#3b82f6',
                          stroke: '#ffffff',
                          strokeWidth: isSelected ? 1.5 : 0.5,
                          outline: 'none',
                          transition: 'all 0.3s ease',
                        },
                        hover: {
                          fill: isSelected ? '#1a4299' : '#2563eb',
                          stroke: '#ffffff',
                          strokeWidth: 1.5,
                          outline: 'none',
                        },
                        pressed: {
                          fill: '#1a4299',
                          stroke: '#ffffff',
                          strokeWidth: 1.5,
                          outline: 'none',
                        },
                      }}
                    />
                  );
                })
              }
            </Geographies>
            
            {/* Add state name labels */}
            <Geographies geography={geoUrl}>
              {({ geographies }) =>
                geographies.map((geo) => {
                  const centroid = geo.properties.centroid || [0, 0];
                  const isSelected = selectedState === geo.properties.NAME_1;
                  
                  return (
                    <g key={`label-${geo.rsmKey}`}>
                      {isSelected && (
                        <Marker coordinates={centroid}>
                          <text
                            textAnchor="middle"
                            y={-10}
                            style={{
                              fontFamily: 'system-ui',
                              fill: '#1e40af',
                              fontSize: '12px',
                              fontWeight: 'bold',
                              textShadow: '0px 0px 3px white, 0px 0px 3px white, 0px 0px 3px white',
                              pointerEvents: 'none',
                            }}
                          >
                            {geo.properties.NAME_1}
                          </text>
                        </Marker>
                      )}
                    </g>
                  );
                })
              }
            </Geographies>
          </ZoomableGroup>
        </ComposableMap>
      </div>

      <div id="providers-section" style={{ marginTop: '2rem' }}>
        {selectedState && (
        <div style={{
          background: 'white',
          borderRadius: '12px',
          padding: '20px',
          boxShadow: '0 4px 6px rgba(0,0,0,0.1)',
          marginTop: '20px'
        }}>
          <h3 style={{
            marginTop: 0,
            marginBottom: '20px',
            color: '#1e40af',
            borderBottom: '2px solid #e5e7eb',
            paddingBottom: '10px'
          }}>
            Solar Providers in {selectedState}
          </h3>
          
          {providers.length > 0 ? (
            <div style={{ display: 'grid', gap: '15px' }}>
              {providers.map((provider) => (
                <div key={provider.id} style={{
                  display: 'flex',
                  justifyContent: 'space-between',
                  alignItems: 'center',
                  padding: '15px',
                  background: '#f9fafb',
                  borderRadius: '8px',
                  transition: 'all 0.2s ease',
                  ':hover': {
                    boxShadow: '0 2px 8px rgba(0,0,0,0.1)',
                    transform: 'translateY(-2px)'
                  }
                }}>
                  <div>
                    <div style={{ fontWeight: '600', marginBottom: '5px' }}>{provider.name}</div>
                    <div style={{ color: '#6b7280', fontSize: '0.9em' }}>
                      <i className="fas fa-map-marker-alt" style={{ marginRight: '5px', color: '#3b82f6' }}></i>
                      {provider.location}
                    </div>
                  </div>
                  <div style={{ textAlign: 'right' }}>
                    <div style={{
                      display: 'inline-flex',
                      alignItems: 'center',
                      background: '#fffbeb',
                      color: '#d97706',
                      padding: '4px 10px',
                      borderRadius: '9999px',
                      fontWeight: '500',
                      fontSize: '0.9em'
                    }}>
                      ⭐ {provider.rating}
                    </div>
                    <div style={{ color: '#6b7280', fontSize: '0.85em', marginTop: '4px' }}>
                      <i className="fas fa-comment-alt" style={{ marginRight: '5px', color: '#3b82f6' }}></i>
                      {provider.reviews} reviews
                    </div>
                  </div>
                </div>
              ))}
            </div>
          ) : (
            <div style={{ textAlign: 'center', padding: '20px', color: '#6b7280' }}>
              No solar providers found for this state.
            </div>
          )}
        </div>
      )}
      </div>
    </div>
  );
};

export default InteractiveIndiaMap;
