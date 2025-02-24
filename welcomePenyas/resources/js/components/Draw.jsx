import React, { useEffect, useState } from "react";

export default function Draw() {
    const [grid, setGrid] = useState([]);
    const [crewName, setCrewName] = useState([]);

    useEffect(() => {
        fetch('/draw-results')
            .then(response => response.json())
            .then(data => {
                setGrid(data.grid);
                setCrewName(data.crewName);
            })
            .catch(error => console.error('Errorciño:', error));
    }, []);

    return (
        <div className="flex mx-auto flex-col items-center">
            <h2 className="text-5xl text-center mt-4">Resultados del sorteo</h2>
            {grid.length === 0 ? (
                <p className="text-center mt-5">Aún no ha habido un sorteo en caso de que lo haya recibirá un mail de ello.</p>
            ) : (
                <div className="text-center mt-5 mb-8">
                    <div className="mt-6">
                        <div className="border border-gray-400">
                            {grid.map((row, y) => (
                                <div key={y} className="flex">
                                    {row.map((cell, x) => (
                                        <div
                                            key={x}
                                            className="border border-gray-400 p-10 text-gray-200 w-full h-full bg-cover bg-center align-center relative"
                                            style={{ backgroundImage: cell ? `url('storage/${cell}')` : 'none' }}
                                            title={crewName[y][x] || ''}
                                        >
                                            {!cell && (
                                                <span className="absolute inset-0 flex items-center justify-center">
                                                    {crewName[y][x]}
                                                </span>
                                            )}
                                        </div>
                                    ))}
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}