import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { createRoot } from 'react-dom/client';
import { LayoutDashboard, ShoppingCart, Utensils, ClipboardList, Clock } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';

// Components
import NavIcon from './components/NavIcon';
import StatCard from './components/StatCard';
import OrdersTab from './components/OrdersTab';
import PlanningTab from './components/PlanningTab';
import ShoppingListTab from './components/ShoppingListTab';

const App = () => {
    const [activeTab, setActiveTab] = useState('orders');
    const [data, setData] = useState({ orders: [], planning: { ingredients_needed: [], shopping_list: [], estimated_total_time_minutes: 0 } });
    const [loading, setLoading] = useState(true);

    const fetchData = async () => {
        setLoading(true);
        try {
            const response = await axios.get('/api/planning');
            setData(response.data);
        } catch (error) {
            console.error('Error fetching data:', error);
        } finally {
            setLoading(false);
        }
    };

    const updateOrderStatus = async (orderId, status) => {
        try {
            await axios.put(`/api/orders/${orderId}`, { status });
            fetchData();
        } catch (error) {
            console.error('Error updating order:', error);
        }
    };

    useEffect(() => {
        fetchData();
        const interval = setInterval(fetchData, 30000); // 30s refresh
        return () => clearInterval(interval);
    }, []);

    return (
        <div className="min-h-screen bg-[#0A0A0A] text-white selection:bg-[#FF4D00] selection:text-white">
            {/* Sidebar */}
            <nav className="fixed left-0 top-0 h-full w-20 flex flex-col items-center py-8 bg-[#121212] border-r border-white/5 z-50">
                <div className="mb-12">
                    <div className="w-12 h-12 bg-[#FF4D00] rounded-2xl flex items-center justify-center shadow-[0_0_20px_rgba(255,77,0,0.3)]">
                        <Utensils className="text-white" size={24} />
                    </div>
                </div>
                
                <div className="flex flex-col gap-8">
                    <NavIcon icon={<LayoutDashboard />} active={activeTab === 'orders'} onClick={() => setActiveTab('orders')} />
                    <NavIcon icon={<ClipboardList />} active={activeTab === 'plan'} onClick={() => setActiveTab('plan')} />
                    <NavIcon icon={<ShoppingCart />} active={activeTab === 'shopping'} onClick={() => setActiveTab('shopping')} />
                </div>
            </nav>

            {/* Main Content */}
            <main className="pl-32 pr-8 py-12">
                <header className="mb-12 flex justify-between items-end">
                    <div>
                        <h1 className="text-4xl font-black bg-gradient-to-r from-white to-white/40 bg-clip-text text-transparent mb-2">
                            SISTEMA COZINHA
                        </h1>
                        <p className="text-white/40 uppercase tracking-[0.2em] text-xs font-bold">Hub de Produção Inteligente</p>
                    </div>
                    <div className="flex gap-4">
                        <StatCard icon={<Clock />} value={`${data.planning.estimated_total_time_minutes}m`} label="Sincronia Prep" />
                        <StatCard icon={<ClipboardList />} value={data.orders.length} label="Pedidos Ativos" />
                    </div>
                </header>

                <AnimatePresence mode="wait">
                    {loading ? (
                        <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} className="flex items-center justify-center h-64">
                            <div className="w-8 h-8 border-2 border-[#FF4D00] border-t-transparent rounded-full animate-spin"></div>
                        </motion.div>
                    ) : (
                        <motion.div
                            key={activeTab}
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            exit={{ opacity: 0, y: -20 }}
                            transition={{ duration: 0.3 }}
                        >
                            {activeTab === 'orders' && <OrdersTab orders={data.orders} onComplete={updateOrderStatus} />}
                            {activeTab === 'plan' && <PlanningTab planning={data.planning} />}
                            {activeTab === 'shopping' && <ShoppingListTab items={data.planning.shopping_list} />}
                        </motion.div>
                    )}
                </AnimatePresence>
            </main>
        </div>
    );
};

const container = document.getElementById('root');
if (container) {
    if (!window._reactRoot) {
        window._reactRoot = createRoot(container);
    }
    window._reactRoot.render(<App />);
}

export default App;
