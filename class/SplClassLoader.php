<?php declare(strict_types=1);

namespace XoopsModules\Modulebuilder;

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <https://www.doctrine-project.org>.
 */

/**
 * SplClassLoader implementation that implements the technical interoperability
 * standards for PHP 5.3 namespaces and class names.
 *
 * https://groups.google.com/group/php-standards/web/psr-0-final-proposal?pli=1
 *
 *     // Example which loads classes for the Doctrine Common package in the
 *     // Doctrine\Common namespace.
 *     $classLoader = new SplClassLoader('Doctrine\Common', '/path/to/doctrine');
 *     $classLoader->register();
 *
 * @license https://www.opensource.org/licenses/mit-license.html  MIT License
 * @author  Jonathan H. Wage <jonwage@gmail.com>
 * @author  Roman S. Borschel <roman@code-factory.org>
 * @author  Matthew Weier O'Phinney <matthew@zend.com>
 * @author  Kris Wallsmith <kris.wallsmith@gmail.com>
 * @author  Fabien Potencier <fabien.potencier@symfony-project.org>
 */
class SplClassLoader
{
    private $_fileExtension      = '.php';
    private $_namespace;
    private $_includePath;
    private $_namespaceSeparator = '\\';

    /**
     * Creates a new <tt>SplClassLoader</tt> that loads classes of the
     * specified namespace.
     *
     * @param string $ns The namespace to use
     * @param null   $includePath
     */
    public function __construct($ns = null, $includePath = null)
    {
        $this->_namespace   = $ns;
        $this->_includePath = $includePath;
    }

    /**
     * Sets the namespace separator used by classes in the namespace of this class loader.
     *
     * @param string $sep The separator to use
     */
    public function setNamespaceSeparator($sep): void
    {
        $this->_namespaceSeparator = $sep;
    }

    /**
     * Gets the namespace seperator used by classes in the namespace of this class loader.
     */
    public function getNamespaceSeparator()
    {
        return $this->_namespaceSeparator;
    }

    /**
     * Sets the base include path for all class files in the namespace of this class loader.
     *
     * @param string $includePath
     */
    public function setIncludePath($includePath): void
    {
        $this->_includePath = $includePath;
    }

    /**
     * Gets the base include path for all class files in the namespace of this class loader.
     *
     * @return string
     */
    public function getIncludePath()
    {
        return $this->_includePath;
    }

    /**
     * Sets the file extension of class files in the namespace of this class loader.
     *
     * @param string $fileExtension
     */
    public function setFileExtension($fileExtension): void
    {
        $this->_fileExtension = $fileExtension;
    }

    /**
     * Gets the file extension of class files in the namespace of this class loader.
     *
     * @return string
     */
    public function getFileExtension()
    {
        return $this->_fileExtension;
    }

    /**
     * Installs this class loader on the SPL autoload stack.
     */
    public function register(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    /**
     * Uninstalls this class loader from the SPL autoloader stack.
     */
    public function unregister(): void
    {
        spl_autoload_unregister([$this, 'loadClass']);
    }

    /**
     * Loads the given class or interface.
     *
     * @param string $className The name of the class to load
     */
    public function loadClass($className): void
    {
        if (null === $this->_namespace || $this->_namespace . $this->_namespaceSeparator === mb_substr($className, 0, mb_strlen($this->_namespace . $this->_namespaceSeparator))) {
            $fileName  = '';
            $namespace = '';
            if (false !== ($lastNsPos = \mb_strrpos($className, $this->_namespaceSeparator))) {
                $namespace .= mb_substr($className, 0, $lastNsPos);
                $className = mb_substr($className, $lastNsPos + 1);
                $fileName  = \str_replace($this->_namespaceSeparator, DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }
            $fileName .= \str_replace('_', DIRECTORY_SEPARATOR, $className) . $this->_fileExtension;

            require (null !== $this->_includePath ? $this->_includePath . DIRECTORY_SEPARATOR : '') . $fileName;
        }
    }
}
