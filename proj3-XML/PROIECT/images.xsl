<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xlink="http://www.w3.org/1999/xlink">
    <xsl:output method="html" indent="yes"/>

    <xsl:template match="/">
        <html>
        <head>
            <title>Image Gallery</title>
            <link rel="stylesheet" href="assets/css/main.css" />
        </head>
        <body>
            <h2>Image Gallery</h2>
            <ul>
                <xsl:for-each select="images/image">
                    <li>
                        <a xlink:href="{path}">
                            <img src="{path}" alt="{title}" style="width:200px;height:200px;"/>
                        </a>
                        <p><xsl:value-of select="title"/></p>
                    </li>
                </xsl:for-each>
            </ul>
        </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
