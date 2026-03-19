import React from 'react';

const StatCard = ({ icon, value, label }) => (
    <div className="bg-white/5 border border-white/5 backdrop-blur-xl p-6 rounded-[2rem] flex items-center gap-4">
        <div className="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-white/40">
            {React.cloneElement(icon, { size: 20 })}
        </div>
        <div>
            <div className="text-2xl font-black">{value}</div>
            <div className="text-[10px] uppercase tracking-wider text-white/40 font-bold">{label}</div>
        </div>
    </div>
);

export default StatCard;
