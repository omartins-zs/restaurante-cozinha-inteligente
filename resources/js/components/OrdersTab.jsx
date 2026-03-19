import React from 'react';
import { Utensils } from 'lucide-react';

const OrdersTab = ({ orders, onComplete }) => (
    <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {orders.map((order) => (
            <div key={order.id} className="group bg-white/5 border border-white/5 hover:border-[#FF4D00]/30 transition-all duration-500 rounded-[2.5rem] p-8 backdrop-blur-3xl overflow-hidden relative">
                <div className="absolute top-0 right-0 p-8 flex gap-2">
                    <span className={`px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest ${
                        order.status === 'pending' ? 'bg-yellow-500/20 text-yellow-500' : 'bg-[#FF4D00]/20 text-[#FF4D00]'
                    }`}>
                        {order.status === 'pending' ? 'pendente' : order.status === 'completed' ? 'concluído' : order.status}
                    </span>
                    {order.status !== 'completed' && (
                        <button 
                            onClick={() => onComplete(order.id, 'completed')}
                            className="p-2 bg-white/5 hover:bg-green-500/20 hover:text-green-500 rounded-full transition-all text-white/20"
                            title="Marcar como Concluído"
                        >
                            <Utensils size={14} />
                        </button>
                    )}
                </div>
                <h3 className="text-2xl font-black mb-4 group-hover:text-[#FF4D00] transition-colors">{order.recipe.name}</h3>
                <div className="flex gap-8 items-center text-white/40">
                    <div>
                        <div className="text-xs uppercase tracking-widest mb-1 font-bold">Quantidade</div>
                        <div className="text-xl font-bold text-white">{order.quantity} unid.</div>
                    </div>
                    <div>
                        <div className="text-xs uppercase tracking-widest mb-1 font-bold">Tempo de Prep</div>
                        <div className="text-xl font-bold text-white">{order.recipe.prep_time_minutes}m</div>
                    </div>
                </div>
                
                <div className="mt-8 flex gap-2">
                    {order.recipe.ingredients.slice(0, 3).map(i => (
                        <span key={i.id} className="px-3 py-1 bg-white/5 rounded-full text-[10px] text-white/40">{i.name}</span>
                    ))}
                    {order.recipe.ingredients.length > 3 && <span className="px-3 py-1 bg-white/5 rounded-full text-[10px] text-white/40">+{order.recipe.ingredients.length - 3} mais</span>}
                </div>
            </div>
        ))}
    </div>
);

export default OrdersTab;
