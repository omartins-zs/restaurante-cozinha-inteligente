import React from 'react';
import { motion } from 'framer-motion';

const NavIcon = ({ icon, active, onClick }) => (
    <button 
        onClick={onClick}
        className={`p-4 rounded-2xl transition-all duration-300 relative group ${
            active ? 'bg-white/5 text-[#FF4D00]' : 'text-white/20 hover:text-white/60 hover:bg-white/5'
        }`}
    >
        {React.cloneElement(icon, { size: 24 })}
        {active && (
            <motion.div 
                layoutId="active-indicator"
                className="absolute -left-0.5 top-1/2 -translate-y-1/2 w-1 h-8 bg-[#FF4D00] rounded-r-full shadow-[2px_0_10px_rgba(255,77,0,0.5)]"
            />
        )}
    </button>
);

export default NavIcon;
