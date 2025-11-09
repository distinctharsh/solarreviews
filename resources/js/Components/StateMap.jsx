import React, { useState, useEffect, useRef } from 'react';
import { MapContainer, TileLayer, GeoJSON, useMap, Popup } from 'react-leaflet';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// Fix for default marker icons
import icon from 'leaflet/dist/images/marker-icon.png';
import iconShadow from 'leaflet/dist/images/marker-shadow.png';

const DefaultIcon = L.icon({
    iconUrl: icon,
    iconRetinaUrl: icon,
    shadowUrl: iconShadow,
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

L.Marker.prototype.options.icon = DefaultIcon;

// Mock data for solar providers (replace with your actual data)
const getSolarProvidersByState = (stateName) => {
    const providers = {
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
            { id: 8, name: 'Vikram Solar', rating: 4.2, reviews: 87, location: 'Chennai' },
            { id: 9, name: 'Waaree Energies', rating: 4.1, reviews: 79, location: 'Coimbatore' }
        ],
        'rajasthan': [
            { id: 10, name: 'SunEdison', rating: 4.3, reviews: 65, location: 'Jaipur' },
            { id: 11, name: 'Rajasthan Solar', rating: 4.0, reviews: 72, location: 'Jodhpur' }
        ]
    };
    return providers[stateName] || [];
};

// Component to handle map initialization and updates
const MapComponent = ({ onStateSelect }) => {
    const map = useMap();
    const geojsonRef = useRef(null);
    const [stateBoundaries, setStateBoundaries] = useState(null);
    const [loading, setLoading] = useState(true);

    // Load India states GeoJSON data
    useEffect(() => {
        const loadStateBoundaries = async () => {
            try {
                const response = await fetch('https://raw.githubusercontent.com/geohacker/india/master/state/india_state.geojson');
                const data = await response.json();
                setStateBoundaries(data);
            } catch (error) {
                console.error('Error loading state boundaries:', error);
            } finally {
                setLoading(false);
            }
        };

        loadStateBoundaries();
    }, []);

    // Style for the states
    const getStyle = (feature) => {
        return {
            fillColor: '#3b82f6',
            weight: 1.5,
            opacity: 1,
            color: '#ffffff',
            dashArray: '0',
            fillOpacity: 0.8,
            className: 'india-state' // Add class for custom styling
        };
    };

    // Handle state click
    const onEachFeature = (feature, layer) => {
        layer.on({
            click: (e) => {
                const stateName = feature.properties.name.toLowerCase().replace(/\s+/g, '-');
                const providers = getSolarProvidersByState(stateName);
                onStateSelect(stateName, providers);
                
                // Highlight the selected state
                if (geojsonRef.current) {
                    geojsonRef.current.eachLayer((layer) => {
                        layer.setStyle({
                            fillColor: '#3388ff',
                            fillOpacity: 0.7
                        });
                    });
                    
                    layer.setStyle({
                        fillColor: '#ff7800',
                        fillOpacity: 0.9
                    });
                }
            },
            mouseover: (e) => {
                const layer = e.target;
                layer.setStyle({
                    weight: 3,
                    color: '#666',
                    dashArray: '',
                    fillOpacity: 0.9
                });
                layer.bringToFront();
            },
            mouseout: (e) => {
                if (geojsonRef.current) {
                    geojsonRef.current.resetStyle(e.target);
                }
            }
        });
    };

    if (loading) {
        return <div style={{ textAlign: 'center', padding: '20px' }}>Loading map...</div>;
    }

    return stateBoundaries ? (
        <GeoJSON
            data={stateBoundaries}
            style={getStyle}
            onEachFeature={onEachFeature}
            ref={geojsonRef}
        />
    ) : (
        <div style={{ textAlign: 'center', padding: '20px' }}>Failed to load map data</div>
    );
};

const StateMap = () => {
    const [selectedState, setSelectedState] = useState(null);
    const [providers, setProviders] = useState([]);
    const [loading, setLoading] = useState(true);
    const mapRef = useRef(null);
    const geojsonRef = useRef(null);

    // Set the initial view to center on India
    const center = [20.5937, 78.9629];
    const zoom = 5;

    // India's boundaries
    const indiaBounds = [
        [6.0, 68.0],   // Southwest coordinates
        [36.0, 98.0]   // Northeast coordinates
    ];

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
            ]
        };
        return providersData[stateName] || [];
    };

    const handleStateSelect = (stateName, latlng) => {
        // Update selected state
        setSelectedState(stateName);
        
        // Get providers for the selected state
        const stateProviders = getSolarProvidersByState(stateName);
        setProviders(stateProviders);
        
        // Show providers container
        const providersContainer = document.getElementById('providers-container');
        if (providersContainer) {
            providersContainer.style.display = 'block';
            
            // Update providers list
            if (stateProviders.length > 0) {
                const providersList = stateProviders.map(provider => `
                    <div class="provider-card">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                            <h3 style="margin: 0; font-size: 1.125rem; color: #1f2937;">${provider.name}</h3>
                            <span class="provider-rating">
                                ⭐ ${provider.rating}
                            </span>
                        </div>
                        <div style="color: #6b7280; margin-bottom: 0.5rem;">
                            <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem; color: #3b82f6;"></i>
                            ${provider.location}
                        </div>
                        <div style="color: #6b7280; font-size: 0.875rem;">
                            <i class="fas fa-comment-alt" style="margin-right: 0.5rem; color: #3b82f6;"></i>
                            ${provider.reviews} reviews
                        </div>
                    </div>
                `).join('');
                
                providersContainer.innerHTML = `
                    <h3 style="margin-top: 0; margin-bottom: 1rem; color: #1e40af; font-size: 1.25rem;">
                        Solar Providers in ${stateName.charAt(0).toUpperCase() + stateName.slice(1)}
                    </h3>
                    <div style="max-height: 400px; overflow-y: auto; padding-right: 0.5rem;">
                        ${providersList}
                    </div>
                `;
            } else {
                providersContainer.innerHTML = `
                    <div style="text-align: center; padding: 2rem; color: #6b7280;">
                        <i class="fas fa-solar-panel" style="font-size: 2rem; color: #9ca3af; margin-bottom: 1rem; display: block;"></i>
                        <p>No solar providers found for this state.</p>
                    </div>
                `;
            }
            
            // Scroll to providers container
            providersContainer.scrollIntoView({ behavior: 'smooth' });
        }
    };

    // Hide loading overlay when component mounts
    useEffect(() => {
        const loadingOverlay = document.getElementById('map-loading');
        if (loadingOverlay) {
            setTimeout(() => {
                loadingOverlay.style.opacity = '0';
                setTimeout(() => {
                    loadingOverlay.style.display = 'none';
                    setLoading(false);
                }, 300);
            }, 500);
        }
    }, []);

    // Function to style each feature
    const styleFeature = (feature) => {
        return {
            fillColor: '#3b82f6',
            weight: 1,
            opacity: 1,
            color: 'white',
            fillOpacity: 0.7,
            className: 'india-state'
        };
    };

    // Function to handle feature click
    const onEachFeature = (feature, layer) => {
        if (feature.properties && feature.properties.name) {
            const stateName = feature.properties.name.toLowerCase().replace(/\s+/g, '-');
            
            // Bind click event
            layer.on({
                click: (e) => {
                    // Prevent default behavior
                    e.originalEvent.preventDefault();
                    e.originalEvent.stopPropagation();
                    
                    // Update selected state
                    handleStateSelect(stateName, e.latlng);
                    
                    // Update style for selected state
                    if (geojsonRef.current) {
                        geojsonRef.current.eachLayer((layer) => {
                            layer.setStyle(styleFeature(feature));
                        });
                        
                        // Highlight selected state
                        layer.setStyle({
                            fillColor: '#1d4ed8',
                            fillOpacity: 0.9,
                            weight: 2,
                            color: '#ffffff'
                        });
                    }
                },
                mouseover: (e) => {
                    const layer = e.target;
                    layer.setStyle({
                        weight: 2,
                        fillOpacity: 0.9,
                        color: '#ffffff'
                    });
                },
                mouseout: (e) => {
                    if (geojsonRef.current) {
                        geojsonRef.current.resetStyle(e.target);
                    }
                }
            });
        }
    };

    return (
        <MapContainer 
            center={center} 
            zoom={zoom} 
            style={{ 
                height: '100%', 
                width: '100%',
                backgroundColor: '#f8f9fa'
            }}
            zoomControl={true}
            scrollWheelZoom={true}
            ref={mapRef}
            minZoom={4}
            maxZoom={8}
            maxBounds={indiaBounds}
            maxBoundsViscosity={1.0}
            zoomSnap={0.5}
            zoomDelta={0.5}
            attributionControl={false}
        >
            {/* Base map layer */}
            <TileLayer
                url="https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png"
                noWrap={true}
                bounds={indiaBounds}
            />
            
            {/* Labels layer */}
            <TileLayer
                url="https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png"
                noWrap={true}
                bounds={indiaBounds}
            />
            
            {/* India states GeoJSON */}
            {!loading && (
                <GeoJSON
                    data="https://raw.githubusercontent.com/geohacker/india/master/state/india_state.geojson"
                    style={styleFeature}
                    onEachFeature={onEachFeature}
                    ref={geojsonRef}
                />
            )}
        </MapContainer>
    );

};

export default StateMap;
