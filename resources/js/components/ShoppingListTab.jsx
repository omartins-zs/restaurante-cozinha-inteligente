import React from 'react';
import { ShoppingCart } from 'lucide-react';

const ShoppingListTab = ({ items }) => (
    <div className="bg-[#FF4D00]/5 border border-[#FF4D00]/10 rounded-[3rem] p-10 backdrop-blur-3xl">
        <div className="flex items-center gap-4 mb-8">
            <ShoppingCart className="text-[#FF4D00]" size={32} />
            <h2 className="text-2xl font-black text-[#FF4D00]">Lista de Compras Urgente</h2>
        </div>
        <div className="flex flex-col gap-4">
            {items.map((item) => (
                <div key={item.id} className="bg-black/40 p-6 rounded-3xl flex justify-between items-center border border-white/5 group hover:border-[#FF4D00]/20 transition-all">
                    <div>
                        <div className="text-xl font-black mb-1 group-hover:text-[#FF4D00] transition-colors">{item.name}</div>
                        <div className="text-xs text-white/40 font-bold tracking-widest">Em Estoque: {item.stock} {item.unit}</div>
                    </div>
                    <div className="text-right">
                        <div className="text-xs uppercase tracking-widest text-[#FF4D00] font-black mb-1">Qtd p/ Comprar</div>
                        <div className="text-3xl font-black tracking-tighter">{item.to_buy} {item.unit}</div>
                    </div>
                </div>
            ))}
            {items.length === 0 && (
                <div className="text-center py-20 text-white/20 italic">
                    Excelente! Você tem estoque suficiente para todos os pedidos ativos.
                </div>
            )}
        </div>
    </div>
);

export default ShoppingListTab;
