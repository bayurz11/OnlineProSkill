// resources/js/components/AnimatedComponent.jsx
import React from 'react';
import { motion } from 'framer-motion';

const AnimatedComponent = () => {
    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ duration: 1 }}
            className="bg-blue-500 p-4 text-white"
        >
            Selamat datang di Framer Motion di Laravel!
        </motion.div>
    );
};

export default AnimatedComponent;
