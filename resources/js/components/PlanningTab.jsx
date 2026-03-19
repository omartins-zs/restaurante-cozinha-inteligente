import React from 'react';
import { motion } from 'framer-motion';

const PlanningTab = ({ planning }) => (
    <div className="bg-white/5 border border-white/5 rounded-[3rem] p-10 backdrop-blur-3xl">
        <h2 className="text-2xl font-black mb-8">Requisitos de Produção</h2>
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {planning.ingredients_needed.map((item) => {
                const consumptionPercentage = Math.min(100, (item.quantity / item.current_stock) * 100);
                return (
                    <div key={item.id} className="bg-white/5 p-6 rounded-[2rem] border border-white/5 overflow-hidden group">
                        <div className="text-xs uppercase tracking-widest text-white/40 font-bold mb-4">{item.name}</div>
                        <div className="flex justify-between items-end mb-4">
                            <div className="text-2xl font-black">{item.quantity} {item.unit}</div>
                            <div className={`text-[10px] font-bold uppercase ${item.current_stock < item.quantity ? 'text-[#FF4D00]' : 'text-green-500'}`}>
                                Estoque: {item.current_stock}
                            </div>
                        </div>
                        {/* Progress Bar */}
                        <div className="h-1 bg-white/5 rounded-full relative">
                            <motion.div 
                                initial={{ width: 0 }}
                                animate={{ width: `${consumptionPercentage}%` }}
                                className={`h-full rounded-full ${item.quantity > item.current_stock ? 'bg-[#FF4D00]' : 'bg-green-500/50'}`}
                            />
                        </div>
                        <div className="mt-2 text-[8px] uppercase tracking-tighter text-white/20 font-bold">
                            {consumptionPercentage.toFixed(0)}% do Estoque Comprometido
                        </div>
                    </div>
                );
            })}
        </div>
    </div>
);

export default PlanningTab;
