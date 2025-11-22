<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WooWApp Pro - Documentación Completa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background: #f8f9fa;
            line-height: 1.6;
        }

        header {
            background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
            color: white;
            padding: 2rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-bar {
            width: 300px;
        }

        .search-bar input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: none;
            border-radius: 25px;
            background: rgba(255,255,255,0.2);
            color: white;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .search-bar input::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .search-bar input:focus {
            background: rgba(255,255,255,0.3);
            outline: none;
            box-shadow: 0 0 10px rgba(255,255,255,0.2);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2rem;
            padding: 2rem;
        }

        aside {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            height: fit-content;
            position: sticky;
            top: 100px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .toc-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #128c7e;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .toc-list {
            list-style: none;
        }

        .toc-list li {
            margin: 0.3rem 0;
        }

        .toc-list a {
            color: #555;
            text-decoration: none;
            font-size: 0.95rem;
            display: block;
            padding: 0.6rem 1rem;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }

        .toc-list a:hover {
            color: #25d366;
            border-left-color: #25d366;
            background: #f0fdf4;
        }

        .toc-list a.active {
            color: #25d366;
            border-left-color: #25d366;
            background: #f0fdf4;
            font-weight: 600;
        }

        main {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        section {
            margin-bottom: 3rem;
            scroll-margin-top: 120px;
        }

        h1 {
            font-size: 2.5rem;
            color: #128c7e;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        h2 {
            font-size: 1.8rem;
            color: #25d366;
            margin-top: 2rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding-bottom: 0.8rem;
            border-bottom: 3px solid #f0fdf4;
        }

        h3 {
            font-size: 1.25rem;
            color: #333;
            margin-top: 1.5rem;
            margin-bottom: 0.8rem;
        }

        p {
            color: #555;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        ul, ol {
            margin-left: 2rem;
            margin-bottom: 1rem;
            color: #555;
        }

        li {
            margin-bottom: 0.6rem;
        }

        strong {
            color: #128c7e;
            font-weight: 600;
        }

        em {
            font-style: italic;
            color: #666;
        }

        .info-box {
            background: #f0fdf4;
            border-left: 4px solid #25d366;
            padding: 1.2rem;
            margin: 1.5rem 0;
            border-radius: 5px;
            font-size: 0.95rem;
        }

        .info-box strong {
            color: #128c7e;
        }

        .warning-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 1.2rem;
            margin: 1.5rem 0;
            border-radius: 5px;
            font-size: 0.95rem;
        }

        .warning-box strong {
            color: #d97706;
        }

        .code-block {
            background: #1e293b;
            color: #e2e8f0;
            padding: 1.2rem;
            border-radius: 5px;
            overflow-x: auto;
            margin: 1rem 0;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .step {
            background: #f8f9fa;
            padding: 1rem;
            margin: 0.8rem 0;
            border-radius: 5px;
            border-left: 3px solid #25d366;
        }

        .step strong {
            color: #128c7e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            font-size: 0.95rem;
        }

        th {
            background: #f0fdf4;
            color: #128c7e;
            padding: 0.8rem;
            text-align: left;
            font-weight: 600;
            border: 1px solid #d1fae5;
        }

        td {
            padding: 0.8rem;
            border: 1px solid #d1fae5;
            color: #555;
        }

        tr:nth-child(even) {
            background: #f9fce8;
        }

        .btn {
            display: inline-block;
            background: #25d366;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            margin: 0.5rem 0;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn:hover {
            background: #128c7e;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }

        .btn-secondary {
            background: #e0f2fe;
            color: #0369a1;
        }

        .btn-secondary:hover {
            background: #bae6fd;
        }

        .highlight {
            background: #fef3c7;
            padding: 0.2rem 0.4rem;
            border-radius: 3px;
            font-weight: 500;
        }

        @media (max-width: 1024px) {
            .container {
                grid-template-columns: 1fr;
            }

            aside {
                position: static;
            }

            .search-bar {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            h1 {
                font-size: 1.8rem;
            }

            h2 {
                font-size: 1.4rem;
            }

            main {
                padding: 1.5rem;
            }

            .search-bar {
                width: 100%;
            }
        }

        .intro-banner {
            background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 100%);
            padding: 2rem;
            border-radius: 10px;
            border: 2px solid #d1fae5;
            margin-bottom: 2rem;
        }

        .intro-banner p {
            color: #047857;
            font-size: 1.1rem;
            margin: 0.5rem 0;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .feature {
            background: #f0fdf4;
            padding: 1.2rem;
            border-radius: 8px;
            border: 1px solid #d1fae5;
        }

        .feature strong {
            color: #128c7e;
            display: block;
            margin-bottom: 0.5rem;
        }

        footer {
            text-align: center;
            padding: 2rem;
            color: #999;
            font-size: 0.9rem;
        }

        .version-badge {
            display: inline-block;
            background: #25d366;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-left: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">📱 WooWApp Pro <span class="version-badge">v2.2.2</span></div>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Buscar documentación...">
            </div>
        </div>
    </header>

    <div class="container">
        <aside>
            <div class="toc-title">📑 Contenido</div>
            <ul class="toc-list">
                <li><a href="#intro" class="toc-link">Introducción</a></li>
                <li><a href="#paso1" class="toc-link">1. Primeros Pasos</a></li>
                <li><a href="#paso2" class="toc-link">2. Instalación</a></li>
                <li><a href="#paso3" class="toc-link">3. Activación</a></li>
                <li><a href="#paso4" class="toc-link">4. Configuración</a></li>
                <li><a href="#paso5" class="toc-link">5. Placeholders</a></li>
                <li><a href="#paso6" class="toc-link">6. Tareas Programadas</a></li>
                <li><a href="#paso7" class="toc-link">7. Troubleshooting</a></li>
                <li><a href="#soporte" class="toc-link">8. Soporte</a></li>
            </ul>
        </aside>

        <main>
            <section id="intro">
                <h1>🚀 WooWApp Pro</h1>
                <div class="intro-banner">
                    <p><strong>Conecta tu tienda WooCommerce con WhatsApp y SMS automáticamente.</strong></p>
                    <p>Envía notificaciones vitales, recupera carritos abandonados e incentiva reseñas de productos con la plataforma SMSenlinea.</p>
                </div>

                <div class="features">
                    <div class="feature">
                        <strong>✉️ Notificaciones</strong>
                        <p>Alertas de estado de pedidos en tiempo real</p>
                    </div>
                    <div class="feature">
                        <strong>🛒 Carrito Abandonado</strong>
                        <p>Recupera ventas perdidas automáticamente</p>
                    </div>
                    <div class="feature">
                        <strong>⭐ Reseñas</strong>
                        <p>Incentiva opiniones con cupones de recompensa</p>
                    </div>
                    <div class="feature">
                        <strong>📊 Análisis</strong>
                        <p>Registros detallados de cada envío</p>
                    </div>
                </div>
            </section>

            <section id="paso1">
                <h2>📋 1. Primeros Pasos</h2>

                <h3>1.1 Crear Cuenta en SMSenlinea</h3>
                <p>WooWApp se integra con dos paneles diferentes. Elige el que mejor se adapte a tus necesidades:</p>

                <div class="step">
                    <strong>✅ Opción A: Panel 2 (Recomendado para WhatsApp)</strong>
                    <ol>
                        <li>Regístrate en <a href="https://api.smsenlinea.com/login" target="_blank">api.smsenlinea.com</a></li>
                        <li>Crea una nueva "Instancia" de WhatsApp</li>
                        <li>Escanea el código QR con WhatsApp Business desde tu teléfono</li>
                        <li>Obtén tu <strong>Token de Autenticación</strong> y <strong>Número de Remitente</strong> (incluye código de país, ej: 573001234567)</li>
                    </ol>
                </div>

                <div class="step">
                    <strong>⚙️ Opción B: Panel 1 (SMS y WhatsApp API clásica)</strong>
                    <ol>
                        <li>Regístrate en <a href="https://whatsapp.smsenlinea.com" target="_blank">whatsapp.smsenlinea.com</a> tambien puede ingresar a la página principal de <a href="https://smsenlinea.com" target="_blank";>smsenlinea.com</a> y registrarse en el <b>panel 1</b> o <b>Panel 2</b> </li>
                        <li>Vincula dispositivos Android o configura WhatsApp API</li>
                        <li>Obtén tu <strong>API Secret</strong> y los IDs correspondientes</li>
                    </ol>
                </div>

                <div class="info-box">
                    <strong>💡 Nota:</strong> El Panel 2 es más fácil para WhatsApp. El Panel 1 ofrece más flexibilidad pero requiere configuración adicional.
                </div>

                <h3>1.2 Descargar Plugin y Licencia</h3>
                <ol>
                    <li>Inicia sesión en <a href="https://descargas.smsenlinea.com/login.php" target="_blank">descargas.smsenlinea.com</a></li>
                    <li>Descarga el plugin WooWApp Pro (archivo .zip)</li>
                    <li>Ve a "Mis Licencias" y copia tu <strong>Clave de Licencia</strong></li>
                </ol>
            </section>

            <section id="paso2">
                <h2>💾 2. Instalación en WordPress</h2>
                <p>El proceso es idéntico al de cualquier plugin premium:</p>

                <div class="step">
                    <strong>Paso a paso:</strong>
                    <ol>
                        <li>Ve a <strong>Plugins > Añadir nuevo</strong></li>
                        <li>Haz clic en <strong>"Subir plugin"</strong></li>
                        <li>Selecciona el archivo .zip de WooWApp Pro</li>
                        <li>Haz clic en <strong>"Instalar ahora"</strong></li>
                        <li>Una vez instalado, haz clic en <strong>"Activar plugin"</strong></li>
                    </ol>
                </div>

                <div class="warning-box">
                    <strong>⚠️ Requisitos mínimos:</strong>
                    <ul>
                        <li>WordPress 5.0 o superior</li>
                        <li>WooCommerce 3.0.0 o superior (¡debe estar activo!)</li>
                        <li>PHP 7.3 o superior (recomendado 7.4+)</li>
                    </ul>
                </div>
            </section>

            <section id="paso3">
                <h2>🔑 3. Activación de la Licencia</h2>
                <p>Inmediatamente después de activar el plugin, serás redirigido a la página de activación.</p>

                <div class="step">
                    <strong>Activar licencia:</strong>
                    <ol>
                        <li>Pega tu clave en el campo "Clave de Licencia"</li>
                        <li>Haz clic en <strong>"Guardar Cambios y Activar"</strong></li>
                        <li>Verifica que el estado sea <span class="highlight">"Tu licencia está activa"</span></li>
                    </ol>
                </div>

                <div class="info-box">
                    <strong>✅ Importante:</strong> Necesitas una licencia activa para enviar notificaciones y recibir actualizaciones. Si tienes problemas, verifica que la clave sea correcta y que no hayas excedido el límite de activaciones.
                </div>
            </section>

            <section id="paso4">
                <h2>⚙️ 4. Configuración Principal</h2>
                <p>Ve a <strong>WooCommerce > Ajustes > WooWApp</strong> para configurar todas las opciones.</p>

                <h3>4.1 Pestaña: Administración</h3>
                <ul>
                    <li><strong>Seleccionar API:</strong> Elige Panel 2 (QR) o Panel 1 (Clásico)</li>
                    <li><strong>Credenciales:</strong> Ingresa Token/Secret según tu panel</li>
                    <li><strong>Código de País:</strong> Ej. 57 para Colombia (respaldo si el cliente no lo selecciona)</li>
                    <li><strong>Adjuntar Imagen de Producto:</strong> Solo en notificaciones de pedidos (WhatsApp)</li>
                    <li><strong>Registro de Actividad:</strong> ✅ Recomendado activar para diagnosticar problemas</li>
                    <li><strong>Prueba de Envío:</strong> Valida que tus credenciales funcionan</li>
                </ul>

                <h3>4.2 Pestaña: Mensajes Admin</h3>
                <p>Configura notificaciones que reciben los administradores:</p>
                <ul>
                    <li>Números de teléfono de administradores (uno por línea)</li>
                    <li>Plantillas personalizables para cada estado de pedido</li>
                    <li>Notificaciones de reseñas pendientes de aprobación</li>
                </ul>

                <h3>4.3 Pestaña: Mensajes Cliente</h3>
                <p>Mensajes automáticos para clientes cuando ocurren eventos:</p>
                <ul>
                    <li>Notificaciones de estado de pedido</li>
                    <li>Nuevas notas de pedido</li>
                    <li>Plantillas personalizables con placeholders dinámicos</li>
                </ul>

                <h3>4.4 Pestaña: Notificaciones</h3>
                <p>Funcionalidades avanzadas:</p>

                <div class="feature">
                    <strong>⭐ Recordatorio de Reseña</strong>
                    <p>Solicita reseñas X días después de completar el pedido. Incluye enlace directo y opción de hacer la calificación obligatoria.</p>
                </div>

                <div class="feature">
                    <strong>🎁 Recompensa por Reseña</strong>
                    <p>Envía un cupón único y automático cuando apruebes una reseña que cumpla con la calificación mínima requerida.</p>
                </div>

                <div class="feature">
                    <strong>🛒 Recuperación de Carrito Abandonado</strong>
                    <p>Configura hasta 3 mensajes de seguimiento en intervalos personalizables (minutos, horas, días). Cada uno puede incluir cupón de descuento.</p>
                </div>
            </section>

            <section id="paso5">
                <h2>✨ 5. Placeholders (Variables Dinámicas)</h2>
                <p>Usa placeholders en tus plantillas para insertar información que se actualiza automáticamente:</p>

                <table>
                    <tr>
                        <th>Categoría</th>
                        <th>Placeholders</th>
                    </tr>
                    <tr>
                        <td><strong>Tienda</strong></td>
                        <td>{shop_name}, {shop_url}, {my_account_link}</td>
                    </tr>
                    <tr>
                        <td><strong>Pedido</strong></td>
                        <td>{order_id}, {order_status}, {order_date}, {order_total}, {order_items}</td>
                    </tr>
                    <tr>
                        <td><strong>Cliente</strong></td>
                        <td>{customer_name}, {first_name}, {billing_email}, {billing_phone}</td>
                    </tr>
                    <tr>
                        <td><strong>Producto</strong></td>
                        <td>{first_product_name}, {first_product_link}, {product_image_url}</td>
                    </tr>
                    <tr>
                        <td><strong>Carrito</strong></td>
                        <td>{cart_total}, {cart_items}, {checkout_link}, {recovery_link_short}</td>
                    </tr>
                    <tr>
                        <td><strong>Cupones</strong></td>
                        <td>{coupon_code}, {coupon_amount}, {coupon_expires}</td>
                    </tr>
                    <tr>
                        <td><strong>Reseñas</strong></td>
                        <td>{first_product_review_link}, {review_rating}, {review_moderation_link}</td>
                    </tr>
                </table>

                <div class="info-box">
                    <strong>💡 Tip:</strong> En los campos de plantilla, haz clic en "Variables y Emojis" para ver la lista completa de placeholders disponibles para ese campo específico.
                </div>
            </section>

            <section id="paso6">
                <h2>⏰ 6. Tareas Programadas (Cron Jobs)</h2>
                <p>WooWApp ejecuta tareas automáticamente en segundo plano:</p>

                <ul>
                    <li>Revisar carritos abandonados</li>
                    <li>Enviar recordatorios de reseña</li>
                    <li>Limpiar cupones vencidos</li>
                </ul>

                <h3>Opción A: WP-Cron (Por Defecto)</h3>
                <div class="info-box">
                    <strong>✅ Ventaja:</strong> Sin configuración adicional.<br>
                    <strong>⚠️ Desventaja:</strong> Puede ser poco fiable con poco tráfico.
                </div>

                <h3>Opción B: Cron Externo (Recomendado)</h3>
                <div class="step">
                    <strong>Configuración en cron-job.org:</strong>
                    <ol>
                        <li>Ve a <strong>WooCommerce > Ajustes > WooWApp > Administración</strong></li>
                        <li>Copia la <strong>"URL de Disparo (Trigger)"</strong></li>
                        <li>Crea una cuenta en <a href="https://cron-job.org" target="_blank">cron-job.org</a></li>
                        <li>Crea un nuevo cronjob con la URL cada <strong>5 minutos</strong></li>
                        <li>(Opcional) Desactiva WP-Cron añadiendo a wp-config.php:</li>
                    </ol>
                </div>

                <div class="code-block">
define('DISABLE_WP_CRON', true);
                </div>
            </section>

            <section id="paso7">
                <h2>❓ 7. Resolución de Problemas</h2>

                <h3>Los mensajes no se envían</h3>
                <div class="warning-box">
                    <strong>Checklist de diagnóstico:</strong>
                    <ol>
                        <li>✓ Verifica que tu <strong>licencia esté activa</strong> en Ajustes > Licencia</li>
                        <li>✓ Valida que <strong>credenciales API</strong> sean correctas y coincidan con SMSenlinea</li>
                        <li>✓ Usa el botón <strong>"Enviar Mensaje de Prueba"</strong> para validar conexión</li>
                        <li>✓ Revisa los logs en <strong>WooCommerce > Estado > Registros</strong> (busca wse-pro-...)</li>
                        <li>✓ Verifica que el número incluya código de país completo (ej: 573001234567)</li>
                        <li>✓ Si es carrito/reseña, confirma que el cron esté funcionando</li>
                    </ol>
                </div>

                <h3>Errores comunes en logs</h3>
                <ul>
                    <li><strong>"Invalid phone number":</strong> Falta código de país o número incorrecto</li>
                    <li><strong>"API Error":</strong> Verifica credenciales en SMSenlinea</li>
                    <li><strong>"Cooldown active":</strong> Espera antes de enviar nuevos mensajes de prueba</li>
                    <li><strong>"¡Atascado! en test-abandoned-cart.php":</strong> WP-Cron no funciona bien, usa cron externo</li>
                </ul>

                <h3>Las actualizaciones no aparecen</h3>
                <ul>
                    <li>Verifica que la <strong>licencia esté activa</strong></li>
                    <li>Fuerza la comprobación en <strong>Escritorio > Actualizaciones > Comprobar de nuevo</strong></li>
                    <li>WordPress busca cada 48 horas; puedes esperar o forzar manualmente</li>
                </ul>

                <h3>Error Crítico del Sitio</h3>
                <div class="step">
                    <strong>Pasos para diagnosticar:</strong>
                    <ol>
                        <li>Edita <strong>wp-config.php</strong> y descomenta:</li>
                    </ol>
                </div>

                <div class="code-block">
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
                </div>

                <p>Luego revisa el archivo <strong>wp-content/debug.log</strong> para el error PHP específico.</p>
            </section>

            <section id="soporte">
                <h2>📞 8. Soporte</h2>
                <p>Si necesitas ayuda adicional, por favor contacta a SMSenlinea a través de los canales de soporte oficiales.</p>

                <div class="info-box">
                    <strong>✅ Antes de contactar:</strong>
                    <ul>
                        <li>Revisa los registros en WooCommerce > Estado > Registros</li>
                        <li>Realiza una prueba de envío desde los ajustes</li>
                        <li>Verifica que tu licencia esté activa</li>
                        <li>Confirma que tus credenciales API son correctas</li>
                    </ul>
                </div>

                <p style="margin-top: 2rem; text-align: center; color: #999;">
                    <strong>WooWApp Pro v2.2.2</strong> • Desarrollado por SMSenlinea • © 2024
                </p>
            </section>
        </main>
    </div>

    <footer>
        <p>Documentación completa de WooWApp Pro - Actualizado a enero 2025</p>
    </footer>

    <script>
        // Navegación en tabla de contenidos
        const tocLinks = document.querySelectorAll('.toc-link');
        
        tocLinks.forEach(link => {
            link.addEventListener('click', function() {
                tocLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Scroll spy - actualizar link activo al hacer scroll
        window.addEventListener('scroll', () => {
            let current = '';
            const sections = document.querySelectorAll('section');
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            tocLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').slice(1) === current) {
                    link.classList.add('active');
                }
            });
        });

        // Búsqueda en la documentación
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const sections = document.querySelectorAll('section');
            
            sections.forEach(section => {
                const text = section.textContent.toLowerCase();
                if (text.includes(searchTerm) || searchTerm === '') {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });

            if (searchTerm) {
                tocLinks.forEach(link => link.classList.remove('active'));
            }
        });
    </script>
</body>
</html>